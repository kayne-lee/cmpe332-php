<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Conference</title>
        <script src="https://cdn.tailwindcss.com"></script>
        
    </head>

    <body class="relative min-h-screen font-mono">
        <div class="fixed top-0 left-0 w-full h-full z-0">
            <div 
                class="w-full h-full bg-gray-100 opacity-20"
                style="background-image: url('bg.jpeg'); background-size: cover; background-position: center; background-attachment: fixed;"
            ></div>
        </div>

        <div class="relative z-10 p-40">
            <?php
                include 'connectdb.php';
                $connection = NULL;
            ?>

            <div>
                <h1 class="font-mono font-bold text-3xl">Hello, Welcome to the Backend of the Conference!</h1>
                <h2 class="font-mono text-2xl">What would you like to see?</h2>
            </div>  
            <div class="flex flex-wrap justify-center items-center gap-4 mt-8 w-100vh font-mono">
                <div class="p-8 w-[400px] h-[200px] bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Sub-Committee Members</h2>

                    <form action="subCommiteeMembers.php" method="post">
                        <?php
                            include 'connectdb.php';
                            $result = $connection->query("SELECT name FROM subCommittee");
                        ?>

                        <select 
                            id="subCommittee"
                            name="subCommittee" 
                            class="block mx-auto w-64 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <?php
                                while ($row = $result->fetch()) {
                                    echo "<option value='".$row['name']."'>";
                                    echo $row['name'];
                                    echo "</option>";

                                }
                            ?>
                        </select>

                        <input type="submit" value="Get Members" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                    </form>
                </div>

                <div class="p-8 w-[400px] h-[200px] bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Room Assignments</h2>

                    <form action="roomAssignments.php" method="post">
                        <?php
                            include 'connectdb.php';
                            $result = $connection->query("SELECT roomNumber FROM room");
                        ?>

                        <select 
                            id="roomNumber"
                            name="roomNumber" 
                            class="block mx-auto w-64 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <?php
                                while ($row = $result->fetch()) {
                                    echo "<option value='".$row['roomNumber']."'>";
                                    echo "Room ".$row['roomNumber'];
                                    echo "</option>";
                                }
                            ?>
                        </select>

                        <input type="submit" value="Get Room Info" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                    </form>
                </div>

                <div class="p-8 w-[400px] h-[200px] bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Conference Schedule</h2>

                    <form action="schedule.php" method="post">
                        <?php
                            include 'connectdb.php';
                            $result = $connection->query("SELECT DISTINCT dateOfEvent FROM sessions ORDER BY dateOfEvent");
                        ?>

                        <select 
                            id="dateOfEvent"
                            name="dateOfEvent" 
                            class="block mx-auto w-64 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <?php
                                while ($row = $result->fetch()) {
                                    echo "<option value='".$row['dateOfEvent']."'>";
                                    echo $row['dateOfEvent'];
                                    echo "</option>";
                                }
                            ?>
                        </select>

                        <input type="submit" value="View Schedule" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                    </form>
                </div>

                <div class="p-8 w-[400px] h-[200px] bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Sponsor Job Listings</h2>

                    <form action="sponsors.php" method="post">
                        <?php
                            include 'connectdb.php';
                            $result = $connection->query("SELECT name, tier FROM company");
                        ?>

                        <select 
                            id="companyName"
                            name="companyName" 
                            class="block mx-auto w-64 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <?php
                                while ($row = $result->fetch()) {
                                    echo "<option value='".$row['name']."'>";
                                    echo $row['name']." (".$row['tier'].")";
                                    echo "</option>";
                                }
                            ?>
                        </select>

                        <input type="submit" name="viewCompanyJobs" value="View Job Ads" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                        <input type="submit" name="viewAllJobs" value="See All Job Ads" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 cursor-pointer mt-4">
                    </form>
                </div>

                <div class="p-8 w-[400px] h-[200px] bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4 py-6">Conference Attendees</h2>

                    <form action="attendees.php" method="post">
                        <input type="submit" value="See All Attendees" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                    </form>
                </div>

                <div class="p-8 w-[400px] h-[200px] bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Total Conference Intake</h2>

                    <?php
                        include 'connectdb.php';
                        $regQuery = '
                            SELECT SUM(rate) as total FROM (
                                SELECT rate FROM student
                                UNION ALL
                                SELECT rate FROM professional
                            ) AS combined
                        ';
                        $regResult = $connection->query($regQuery);
                        $regTotal = $regResult->fetch()['total'] ?? 0;
                        $tierValues = [
                            "Platinum" => 10000,
                            "Gold" => 5000,
                            "Silver" => 3000,
                            "Bronze" => 1000
                        ];

                        $sponsorTotal = 0;
                        $tierQuery = 'SELECT tier, COUNT(*) as count FROM company GROUP BY tier';
                        $tierResult = $connection->query($tierQuery);

                        while ($row = $tierResult->fetch()) {
                            $tier = $row['tier'];
                            $count = $row['count'];
                            if (isset($tierValues[$tier])) {
                                $sponsorTotal += $tierValues[$tier] * $count;
                            }
                        }
                    ?>

                    <p class="mb-2">Total Registration Amount: 
                        <span class="font-bold">$<?php echo number_format($regTotal, 2); ?></span>
                    </p>

                    <p>Total Sponsorship Amount: 
                        <span class="font-bold">$<?php echo number_format($sponsorTotal, 2); ?></span>
                    </p>
                </div>

            </div>
            
            <div>
                <h2 class="font-mono text-2xl mt-5">What would you like to modify?</h2>
            </div>

            <div class="flex flex-wrap justify-center items-center gap-4 mt-8 w-100vh font-mono">
                <div class="p-8 w-[400px] h-[325px] flex justify-center items-center flex-col bg-white rounded-lg shadow-md text-center font-mono ">
                    <h2 class="text-xl font-bold mb-4">Add a New Attendee</h2>

                    <form action="addAttendee.php" method="post">
                        <select 
                            id="companyName"
                            name="companyName" 
                            class="block mx-auto w-64 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="Student">Student</option>
                            <option value="Professional">Professional</option>
                            <option value="Sponsor">Sponsor</option>
                        </select>

                        <input type="submit" value="Add Attendee" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                    </form>
                </div>

                <div class="p-8 w-[400px] h-[325px] flex justify-center items-center flex-col bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Add a Sponsoring Company</h2>

                    <form action="confirmAddCompany.php" method="post">
                        <label for="companyName" class="block mb-2">Company Name:</label>
                        <input 
                            type="text" 
                            id="companyName" 
                            name="companyName" 
                            required 
                            class="block mx-auto w-64 mb-4 px-3 py-2 border border-gray-300 rounded shadow"
                        >

                        <label for="tier" class="block mb-2">Sponsorship Tier:</label>
                        <select 
                            id="tier"
                            name="tier" 
                            required
                            class="block mx-auto w-64 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="Platinum">Platinum</option>
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                            <option value="Bronze">Bronze</option>
                        </select>

                        <input 
                            type="submit" 
                            value="Add Company" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer"
                        >
                    </form>
                </div>

                <div class="p-8 w-[400px] h-[325px] flex justify-center items-center flex-col bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Delete a Sponsoring Company</h2>

                    <form action="confirmDeleteCompany.php" method="post">
                        <?php
                            include 'connectdb.php';
                            $result = $connection->query("SELECT name FROM company ORDER BY name");
                        ?>

                        <select 
                            id="companyName"
                            name="companyName" 
                            required
                            class="block mx-auto w-64 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-red-500"
                        >
                            <?php
                                while ($row = $result->fetch()) {
                                    echo "<option value='".$row['name']."'>".$row['name']."</option>";
                                }
                            ?>
                        </select>

                        <input 
                            type="submit" 
                            value="Delete Company" 
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 cursor-pointer"
                        >
                    </form>
                </div>

                <div class="p-8 bg-white rounded-lg shadow-md text-center font-mono">
                    <h2 class="text-xl font-bold mb-4">Modify a Session</h2>

                    <form action="editSession.php" method="post">
                        <?php
                            include 'connectdb.php';
                            $result = $connection->query("SELECT * FROM sessions ORDER BY dateOfEvent, startTime");
                        ?>

                        <select 
                            name="sessionId"
                            required
                            class="block mx-auto w-128 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <?php
                                $id = 1;
                                while ($row = $result->fetch()) {
                                    $display = $row['location'] . " on " . $row['dateOfEvent'] . " at " . $row['startTime'];
                                    echo "<option value='".$id."'>$display</option>";
                                    $id++;
                                }
                            ?>
                        </select>

                        <input type="submit" value="Modify Session" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>