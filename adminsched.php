<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FJA Basketball Court Admin</title>
    <link rel="stylesheet" href="page.css">
    <script>
        function updateSlots() {
            var court = document.getElementById("court").value;
            var timeSelect = document.getElementById("time");
            timeSelect.innerHTML = ""; // Clear previous options

            if (court === "Andoy") {
                addOption(timeSelect, "5:00pm - 7:00pm", "5:00-7:00");
                addOption(timeSelect, "7:00pm - 9:00pm", "7:00-9:00");
                addOption(timeSelect, "9:00pm - 11:00pm", "9:00-11:00");
            } else if (court === "Juliet") {
                addOption(timeSelect, "4:00pm - 6:00pm", "4:00-6:00");
                addOption(timeSelect, "6:00pm - 8:00pm", "6:00-8:00");
                addOption(timeSelect, "8:00pm - 10:00pm", "8:00-10:00");
                addOption(timeSelect, "10:00pm - 12:00am", "10:00-12:00");
            }
        }

        function addOption(selectElement, text, value) {
            var option = document.createElement("option");
            option.text = text;
            option.value = value;
            selectElement.add(option);
        }

        function setMinMaxDate() {
            var today = new Date();
            var year = today.getFullYear();
            var month = today.getMonth() + 1;
            var day = today.getDate();
            var minDate = `${year-1}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            var maxDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            document.getElementById("date").setAttribute("min", minDate);
            document.getElementById("date").setAttribute("max", maxDate);
        }

        function validateForm() {
            var court = document.getElementById("court").value;
            var date = document.getElementById("date").value;
            var time = document.getElementById("time").value;
            var errorMessage = "";

            if (court === "" || date === "" || time === "") {
                errorMessage = "Please fill in all fields.";
            }

            if (errorMessage) {
                document.getElementById("feedback").innerHTML = errorMessage;
                document.getElementById("feedback").style.display = "block";
                return false;
            }

            return confirm(`Are you sure you want to book the court ${court} on ${date} at ${time}?`);
        }

        function navigateMonth(offset) {
            var currentMonth = parseInt(document.getElementById('currentMonth').value);
            var currentYear = parseInt(document.getElementById('currentYear').value);
            var newDate = new Date(currentYear, currentMonth - 1 + offset, 1);
            document.getElementById('currentMonth').value = newDate.getMonth() + 1;
            document.getElementById('currentYear').value = newDate.getFullYear();
            document.getElementById('monthForm').submit();
        }

        window.onload = setMinMaxDate;
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .sec { animation: fadeIn 1s ease-in-out; }
    </style>
</head>
<body>
    <div id="header" style="height:155px;">
        <img src="fjabasketball.png" id="logo">
        <ul style="width:50%; padding: -20px;">
            <li><a href="admin.php">Home</a></li>
            <li><a href="logbook.php"><b>Log a Schedule</b></a></li>
            <li><a href="weekly.php"><b>Frequently Booked Client</b></a></li>
            <li><a href="court-utilization-report.php"><b>Court Utilization</b></a></li>
            <li><a href="monthly-revenue-report.php"><b>Monthly Revenue</b></a></li>
            <li><a href="audit.php"><b>Audit Trail</b></a></li>
            <li><a href="locked.php"><b>Locked Clients</b></a></li>
            <li><a href="profad.php"><b>Profile</b></a></li>
        </ul>
        <br>
        <div class="profile-header">
            <?php
            if (isset($_SESSION['email'])) {
                require "con.php";
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM client WHERE client_email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $info = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($info) {
                    $profilePicture = $info['pfp'];
                    $firstName = $info['client_firstn'];
                    $lastName = $info['client_lastn'];
                    $cp = $info['client_contnum'];
                    if (!empty($profilePicture)) {
                        echo "<img src='$profilePicture' alt='Profile Picture' class='pfp'>";
                    }
                }
            }
            ?>
            <div class="user-info">
                <h2 class="username">Welcome, <?php echo $firstName . ' ' . $lastName; ?>!</h2>
                <a href="logout.php" class="logout-link"><b>Log out</b></a>
            </div>
        </div>
    </div>

    <div class="sec" style="margin-top:100px; width: 1000px; border-radius:10px;">
        <div class="reservation-form" style="text-align:center;">
            <h3>Book a Court</h3>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div id="feedback" style="color:red; margin-bottom:10px;">
                    <?= htmlspecialchars($_SESSION['error_message']) ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
            <div id="feedback" style="display:none; color:red; margin-bottom:10px;"></div>
            <form action="adm_sched.php" method="post" onsubmit="return validateForm()">
                <label for="court">Select Court:</label>
                <select id="court" name="court" onchange="updateSlots()">
                    <option value="">Select a court</option>
                    <option value="Andoy">Andoy</option>
                    <option value="Juliet">Juliet</option>
                </select><br><br>
                <label for="date">Select Date:</label>
                <input type="date" id="date" name="date"><br><br>
                <label for="time">Select Time Slot:</label>
                <select id="time" name="time">
                    <option value="">Select a time slot</option>
                </select><br><br>
                <label for="sender">Sender Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $cp ?>" style="text-align:center;" disabled><br><br>
                <button type="submit" class="button">Log</button><br>
                <p><b>You need to send a downpayment of 300 pesos to this GCash number:</b></p>
                <p><b>0932 868 1868 - P***** A.</b></p>
            </form>
        </div>
    </div>
    <div class="sec" style="width:96%; border-radius:10px;">
        <div class="schedule-table">
            <h3>Schedule for <span id="monthName"></span> <span id="year"></span></h3>
            <form id="monthForm" method="post" action="admin.php">
                <input type="hidden" id="currentMonth" name="currentMonth" value="<?= isset($_POST['currentMonth']) ? $_POST['currentMonth'] : date('m') ?>">
                <input type="hidden" id="currentYear" name="currentYear" value="<?= isset($_POST['currentYear']) ? $_POST['currentYear'] : date('Y') ?>">
                <button type="button" onclick="navigateMonth(-1)">Previous</button>
                <button type="button" onclick="navigateMonth(1)">Next</button>
            </form>
            <table border="2" style="width:100%; margin-top:20px;">
                <?php
                $currentMonth = isset($_POST['currentMonth']) ? $_POST['currentMonth'] : date('m');
                $currentYear = isset($_POST['currentYear']) ? $_POST['currentYear'] : date('Y');

                $first_day = date('N', strtotime("$currentYear-$currentMonth-01"));
                $last_day = date('j', strtotime("$currentYear-$currentMonth-" . cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear)));
                $days_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

                echo "<table border='1' style='width:100%; margin-top:20px;'>";
                echo "<tr><th colspan='7'>" . date('F Y', strtotime("$currentYear-$currentMonth-01")) . "</th></tr>";
                echo "<tr>";
                foreach ($days_of_week as $day) {
                    echo "<th>$day</th>";
                }
                echo "</tr>";

                $day_counter = 1;
                echo "<tr>";

                for ($i = 1; $i < $first_day; $i++) {
                    echo "<td></td>";
                    $day_counter++;
                }

                $days_in_month = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                for ($day = 1; $day <= $days_in_month; $day++) {
                    $date = date('Y-m-d', strtotime("$currentYear-$currentMonth-$day"));
                    $sql = "SELECT * FROM sched WHERE DATE(sched_timedate) = :date";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':date', $date);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($result) {
                        echo "<td>";
                        echo "<strong>$day</strong><br>";
                        foreach ($result as $row) {
                            echo "Court: <b>" . $row['court_name'] . "</b><br>";
                            echo $row['sched_time'] . "pm - " . $row['sched_end'] . "pm<br>";
                            echo $row['sched_status'] . "<br>";
                        }
                        echo "</td>";
                    } else {
                        echo "<td>$day</td>";
                    }

                    if ($day_counter % 7 == 0) {
                        echo "</tr><tr>";
                    }

                    $day_counter++;
                }

                if ($day_counter % 7 != 1) {
                    for ($i = $day_counter; $i <= $day_counter + (7 - ($day_counter % 7)); $i++) {
                        echo "<td></td>";
                    }
                }

                echo "</tr>";
                echo "</table>";
                ?>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('monthName').innerText = new Date(<?= $currentYear ?>, <?= $currentMonth - 1 ?>).toLocaleString('default', { month: 'long' });
        document.getElementById('year').innerText = <?= $currentYear ?>;
    </script>
</body>
</html>
