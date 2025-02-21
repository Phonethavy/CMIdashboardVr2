<?php
require_once 'connect2.php'; // Include database connection

if (isset($_GET['search']) && isset($_GET['from_month'])) {
    $filtervalues = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $from_month = isset($_GET['from_month']) ? mysqli_real_escape_string($conn, $_GET['from_month']) : '';
    
    if (strlen($from_month) < 7) {
        echo json_encode(['error' => 'Invalid date format']);
        exit;
    }

    $year = substr($from_month, 0, 4);
    $month = substr($from_month, 5);
    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date));

    // Build dynamic query conditions
    $filter_condition = ($filtervalues === '*') ? '' : "`employee`.`empid` LIKE '%$filtervalues%' AND ";
    $province_search = isset($_GET['province_search']) ? mysqli_real_escape_string($conn, $_GET['province_search']) : '';
    $province_condition = !empty($province_search) ? "`employee`.`province` LIKE '%$province_search%' AND " : '';
    $kpi_id_search = isset($_GET['kpi_id_search']) ? mysqli_real_escape_string($conn, $_GET['kpi_id_search']) : '';
    $kpi_id_condition = !empty($kpi_id_search) ? "`tb_data`.`kpi_id` LIKE '%$kpi_id_search%' AND " : '';

    // Final SQL query
    $query = "SELECT tb_data.*, employee.name, job_pisition.jpsid, department.deptid 
              FROM `kpi_data_collection_dbs` AS tb_data 
              INNER JOIN `employee` ON `employee`.`empid` = `tb_data`.`empid` 
              INNER JOIN `job_pisition` ON `job_pisition`.`jpsid` = `employee`.`job_pisition`
              INNER JOIN `department` ON `department`.`deptid` = `employee`.`department` 
              INNER JOIN `kpi_dbs` ON `kpi_dbs`.`kpi_id` = `tb_data`.`kpi_id` 
              WHERE $filter_condition $province_condition $kpi_id_condition tb_data.date BETWEEN '$start_date' AND '$end_date'";

    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        error_log("MySQL error: " . mysqli_error($conn)); // Log SQL errors
        echo json_encode(['error' => 'Database query failed']);
        exit;
    }

    function fetchGoal($year, $kpi_id, $conn) {
        $goal_query = "SELECT `Goal` FROM `tbl_kpi_goal`
                       WHERE YEAR(`date_dim`) = ? AND `code_kpi` = ?";
        
        $goal_stmt = mysqli_prepare($conn, $goal_query);
        mysqli_stmt_bind_param($goal_stmt, "is", $year, $kpi_id); // "i" สำหรับ integer (year), "s" สำหรับ string (kpi_id)
        mysqli_stmt_execute($goal_stmt);
        $goal_result = mysqli_stmt_get_result($goal_stmt);
    
        $goal_row = mysqli_fetch_assoc($goal_result);
        return $goal_row['Goal'] ?? 0; // ถ้าไม่มีค่า ให้ return 0
    }

    function getRatio($kpi_id, $goal) {
        $ratios = [
            "KPI202103" => $goal, "KPI2101" => $goal, "KPI5001" => $goal, "KPI5002" => $goal,
            "KPI5003" => $goal, "KPI5004" => $goal, "KPI5005" => $goal, "KPI6101" => $goal,
            "KPI7107" =>$goal, "KPI8001" => $goal, "KPI9001" => $goal, "KPI5103" => $goal,
            "KPI9004" => $goal, "KPI12002" => $goal, "KPI101001" => $goal, "KPI101002" => $goal,
            "KPI101003" => $goal, "KPI101005" => $goal, "KPI101103" => $goal, "KPI101004" => $goal,
            "KPI102001" => $goal, "KPI102002" => $goal, "KPI102003" => $goal, "KPI103102" => $goal,
            "KPI201102" => $goal, "KPI202102" => $goal, "KPI205001" => $goal,
            "KPI205103" => $goal, "KPI300102" => $goal, "KPI300105" => $goal, "KPI201001" => $goal,
            "KPI201103" => $goal, "KPI7" => $goal,
            "KPI202101" => null // Special formula
        ];
        return $ratios[$kpi_id] ?? null;
    }

    function calculateKPI1($row, $year, $conn) {
        $denominator = $row['denominator'];
        $divisor = $row['divisor'];
        $kpi_id = $row['kpi_id'];

        if (!is_numeric($divisor) || $divisor == 0) {
            return "0%"; // ป้องกัน Division by Zero
        }

        // แก้ไข: ส่ง $kpi_id เข้าไปใน fetchGoal
        $goal = fetchGoal($year, $kpi_id, $conn);
        $ratio = getRatio($kpi_id, $goal);

        if ($ratio === null && $kpi_id === "KPI202101") {
            // เงื่อนไขพิเศษสำหรับ KPI202101
            $result = round((1 - ($denominator / $divisor)) * 100, 2);
        }
        elseif ( $kpi_id === "KPI7") {
            if (!is_numeric($ratio) || $ratio == 0 && $kpi_id === "KPI7") {
                return "0%";
            }
            // ถ้า KPI ไม่อยู่ในรายการ ratio ใช้สูตร (denominator / divisor) * 100
            $result = round((($denominator / $divisor)/($goal / 100)) * 100, 2);
            
        }
        elseif ($ratio === null) {
            // ถ้า KPI ไม่อยู่ในรายการ ratio ใช้สูตร (denominator / divisor) * 100
            $result = round(($denominator / $divisor) * 100, 2);
        }
        elseif ($ratio === null) {
            // ถ้า KPI ไม่อยู่ในรายการ ratio ใช้สูตร (denominator / divisor) * 100
            $result = round(($denominator / $divisor) * 100, 2);
        } else {
            if (!is_numeric($ratio) || $ratio == 0) {
                return "0%";
            }
            $result = round((2 - ($denominator / $divisor) / ($ratio / 100))*100, 2);
        }

        return ($result < 0) ? "0%" : "{$result}%";
    }

    // Prepare JSON response
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'index' => count($data) + 1,
            'empid' => $row['empid'],
            'name' => $row['name'],
            'date' => date('F', strtotime($row['date'])),
            'kpi_id' => $row['kpi_id'],
            'jpsid' => $row['jpsid'],
            'deptid' => $row['deptid'],
            'denominator' => $row['denominator'],
            'divisor' => $row['divisor'],
            'performance' => calculateKPI1($row, $year, $conn)
        ];
    }

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
