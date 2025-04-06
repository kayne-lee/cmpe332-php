<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Conference Attendees</title>
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
                $connection = NULL;
                include 'connectdb.php';
            ?>
            <h2 class="text-2xl font-bold mb-4">Students</h2>
            <table class="w-full max-w-4xl mb-10 border border-gray-400 bg-white rounded shadow">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">First Name</th>
                        <th class="p-2 border">Last Name</th>
                        <th class="p-2 border">Room Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $students = $connection->query("SELECT firstName, lastName, roomNumber FROM student");
                        while ($row = $students->fetch()) {
                            echo "<tr>
                                    <td class='p-2 border'>".$row['firstName']."</td>
                                    <td class='p-2 border'>".$row['lastName']."</td>
                                    <td class='p-2 border'>".$row['roomNumber']."</td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>

            <h2 class="text-2xl font-bold mb-4">Professionals</h2>
            <table class="w-full max-w-4xl mb-10 border border-gray-400 bg-white rounded shadow">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">First Name</th>
                        <th class="p-2 border">Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $pros = $connection->query("SELECT firstName, lastName FROM professional");
                        while ($row = $pros->fetch()) {
                            echo "<tr>
                                    <td class='p-2 border'>".$row['firstName']."</td>
                                    <td class='p-2 border'>".$row['lastName']."</td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>

            <h2 class="text-2xl font-bold mb-4">Sponsors</h2>
            <table class="w-full max-w-4xl border border-gray-400 bg-white rounded shadow">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">First Name</th>
                        <th class="p-2 border">Last Name</th>
                        <th class="p-2 border">Company</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sponsors = $connection->query("SELECT firstName, lastName, company FROM sponsor");
                        while ($row = $sponsors->fetch()) {
                            echo "<tr>
                                    <td class='p-2 border'>".$row['firstName']."</td>
                                    <td class='p-2 border'>".$row['lastName']."</td>
                                    <td class='p-2 border'>".$row['company']."</td>
                                </tr>";
                        }
                        $connection = NULL;
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
