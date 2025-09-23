<?php
session_start(); // Always start the session before using $_SESSION

require_once "../config/db.php";

// Only unset if session variable exists
if (isset($_SESSION['target_a_email'])) {
    unset($_SESSION['target_a_email']);
}

$sql = "SELECT * FROM admin_table ORDER BY name ASC";

if ($exesql = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($exesql) > 0) {
        $i = 0;
        ?>
        <table id="myTable">
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            while ($searchResult = mysqli_fetch_assoc($exesql)) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($searchResult['name']); ?></td>
                    <td><?php echo htmlspecialchars($searchResult['email']); ?></td>
                    <td>
                        <a href="../admin/admin-adminprofile-main.php?a_email=<?php echo urlencode($searchResult['email']); ?>">
                            <button class="show-admin-btn" type="button">Show</button>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "No result found";
    }
} else {
    echo "Query error";
}
?>
