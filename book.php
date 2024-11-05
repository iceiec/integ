<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FJA Basketball Court</title>
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
            var minDate = `${year}-11-01`;
            var maxDate = `${year}-11-30`;
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
        <ul>
            <li><a href="frontlog.php">Home</a></li>
            <li><a href="howto.php">How To Book</a></li>
            <li><a href="book.php"><b>Book A Schedule</b></a></li>
            <li><a href="profile.php"><b>Profile</b></a></li>
            <li><a href="trans.php"><b>Transactions</b></a></li>
        </ul>
        <br>
        <div class="profile-header">
            <?php
            session_start();
            if (isset($_SESSION['email'])) {
                require "client.php";
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM client WHERE client_email = :email";
                $stmt = $conn1->prepare($sql);
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
            <form action="book_schedule.php" method="post" onsubmit="return validateForm()">
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
                <button type="submit" class="button">Pay via GCash</button><br>
            </form>
        </div>
    </div>
    <div class="sec" style="width:96%; border-radius:10px;">
        <div class="schedule-table">
            <h3>Schedule for November</h3>
            <table border="2" style="width:100%; margin-top:20px;">
                <?php
                $first_day = date('N', strtotime('2024-11-01'));
                $last_day = date('j', strtotime('2024-11-' . cal_days_in_month(CAL_GREGORIAN, 11, 2024)));
                $days_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

                echo "<table border='1' style='width:100%; margin-top:20px;'>";
                echo "<tr><th colspan='7'>November 2024</th></tr>";
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

                $days_in_month = cal_days_in_month(CAL_GREGORIAN, 11, 2024);
                for ($day = 1; $day <= $days_in_month; $day++) {
                    $date = date('Y-m-d', strtotime("2024-11-$day"));
                    $sql = "SELECT * FROM sched WHERE DATE(sched_timedate) = :date";
                    $stmt = $conn1->prepare($sql);
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
</body>
</html>
