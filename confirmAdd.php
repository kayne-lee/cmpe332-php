<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Successfully Added!</title>
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
            <?php
                include 'connectdb.php';

                $attendeeType = $_POST["attendeeType"];
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];

                $getMaxIdQuery = '
                                    SELECT MAX(maxId) AS maxUsedId FROM (
                                        SELECT MAX(id) AS maxId FROM student
                                        UNION
                                        SELECT MAX(id) FROM sponsor
                                        UNION
                                        SELECT MAX(id) FROM professional
                                        UNION
                                        SELECT MAX(id) FROM speaker
                                    ) AS combined
                                ';
                $maxResult = $connection->query($getMaxIdQuery);
                $maxId = $maxResult->fetch()['maxUsedId'];
                $newId = intval($maxId) + 1;

                if ($attendeeType === "Student") {
                    $rate = 50;
                    $roomChoice = $_POST["roomNumber"];
                    if ($roomChoice === "new") {
                        $maxRoomQuery = 'SELECT MAX(roomNumber) AS maxRoom FROM room';
                        $maxRoomResult = $connection->query($maxRoomQuery);
                        $maxRoom = $maxRoomResult->fetch()['maxRoom'];
                        $assignedRoom = intval($maxRoom) + 1;

                        $insertRoom = 'INSERT INTO room (roomNumber, numBeds) VALUES ('.$assignedRoom.', 3)';
                        $connection->exec($insertRoom);
                    } else {
                        $assignedRoom = intval($roomChoice);
                    }

                    $insertStudent = 'INSERT INTO student (id, rate, firstName, lastName, roomNumber) 
                     VALUES ('.$newId.', '.$rate.', "'.$firstName.'", "'.$lastName.'", '.$assignedRoom.')';

                    $connection->exec($insertStudent);
                    echo "<h1 class='text-xl font-bold'>Student added to room #$assignedRoom!</h1>";

                } elseif ($attendeeType === "Professional") {
                    $rate = 100;

                    $insertPro = 'INSERT INTO professional (id, rate, firstName, lastName) 
                        VALUES ('.$newId.', '.$rate.', "'.$firstName.'", "'.$lastName.'")';

                    $connection->exec($insertPro);
                    echo "<h1 class='text-xl font-bold'>Professional added!</h1>";
                
                } elseif ($attendeeType === "Sponsor") {
                    $rate = 0;
                    $company = $_POST["company"];
                    $insertSponsor = 'INSERT INTO sponsor (id, rate, firstName, lastName, company) 
                         VALUES ('.$newId.', '.$rate.', "'.$firstName.'", "'.$lastName.'", "'.$company.'")';

                    $connection->exec($insertSponsor);
                    echo "<h1 class='text-xl font-bold'>Sponsor from $company added!</h1>";
                }
                ?>
        </div>
    </body>
</html>
