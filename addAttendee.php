<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Add New Attendee</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="relative bg-gray-100 min-h-screen font-mono">
        <a 
          href="conference.php"
          class="absolute top-100 left-10 mt-4 ml-4 inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
        >
            <svg 
              xmlns="http://www.w3.org/2000/svg"
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor"
              class="w-5 h-5"
            >
                <path 
                  stroke-linecap="round" 
                  stroke-linejoin="round" 
                  d="M2.25 12L12 2.25l9.75 9.75m-17.25 0v9.75c0 
                     .414.336.75.75.75h4.5c.414 0 .75-.336.75-.75V15.75
                     c0-.621.504-1.125 1.125-1.125h1.125c.621 0 
                     1.125.504 1.125 1.125v5.25c0 .414.336.75.75.75h4.5
                     a.75.75 0 00.75-.75v-9.75"
                />
            </svg>
            <span class="ml-2">Home</span>
        </a>

        <div class="p-40">
            <?php $type = $_POST["companyName"]; ?>

            <h1 class="text-2xl font-bold mb-6">Add a New <?php echo $type; ?></h1>

            <form action="confirmAdd.php" method="post" class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
                <input type="hidden" name="attendeeType" value="<?php echo $type; ?>">

                <label class="block mb-2">First Name:</label>
                <input type="text" name="firstName" required class="w-full mb-4 px-3 py-2 border border-gray-300 rounded">

                <label class="block mb-2">Last Name:</label>
                <input type="text" name="lastName" required class="w-full mb-4 px-3 py-2 border border-gray-300 rounded">

                <?php if ($type === "Student"): ?>
                    <?php
                        include 'connectdb.php';
                        $roomQuery = '
                            SELECT r.roomNumber, COUNT(s.id) AS numStudents, r.numBeds
                            FROM room r
                            LEFT JOIN student s ON r.roomNumber = s.roomNumber
                            GROUP BY r.roomNumber, r.numBeds
                            HAVING numStudents < r.numBeds
                            ORDER BY r.roomNumber
                        ';
                        $roomResult = $connection->query($roomQuery);
                    ?>

                    <label class="block mb-2">Assign to a Room:</label>
                    <select name="roomNumber" class="w-full mb-4 px-3 py-2 border border-gray-300 rounded">
                        <?php
                            while ($row = $roomResult->fetch()) {
                                echo "<option value='".$row['roomNumber']."'>Room ".$row['roomNumber']." (".$row['numBeds']." beds, ".$row['numStudents']." filled)</option>";
                            }
                        ?>
                        <option value="new">Create New Room</option>
                    </select>
                    <?php elseif ($type === "Sponsor"): ?>
                        <?php
                            include 'connectdb.php';
                            $companyResult = $connection->query("SELECT name FROM company ORDER BY name");
                        ?>

                        <label class="block mb-2">Company:</label>
                        <select name="company" required class="w-full mb-4 px-3 py-2 border border-gray-300 rounded">
                            <?php
                                while ($row = $companyResult->fetch()) {
                                    echo "<option value='".$row['name']."'>".$row['name']."</option>";
                                }
                            ?>
                        </select>
                    <?php endif; ?>

                <input type="submit" value="Submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
            </form>
        </div>
    </body>
</html>
