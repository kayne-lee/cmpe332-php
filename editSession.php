<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modify Session</title>
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
                $sessionId = $_POST["sessionId"];
                $sessions = $connection->query("SELECT * FROM sessions ORDER BY dateOfEvent, startTime LIMIT 1 OFFSET " . ($sessionId - 1));
                $session = $sessions->fetch();
            ?>
            <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4 text-center">Edit Session</h2>

                <form action="confirmSession.php" method="post">
                    <input type="hidden" name="originalLocation" value="<?= $session['location'] ?>">
                    <input type="hidden" name="originalDate" value="<?= $session['dateOfEvent'] ?>">
                    <input type="hidden" name="originalTime" value="<?= $session['startTime'] ?>">

                    <label class="block mb-2">Location:</label>
                    <input type="text" name="location" value="<?= $session['location'] ?>" required class="w-full mb-4 px-3 py-2 border border-gray-300 rounded">

                    <label class="block mb-2">Date of Event:</label>
                    <input type="date" name="dateOfEvent" value="<?= $session['dateOfEvent'] ?>" required class="w-full mb-4 px-3 py-2 border border-gray-300 rounded">

                    <label class="block mb-2">Start Time:</label>
                    <input type="time" name="startTime" value="<?= substr($session['startTime'], 0, 5) ?>" required class="w-full mb-4 px-3 py-2 border border-gray-300 rounded">

                    <label class="block mb-2">End Time:</label>
                    <input type="time" name="endTime" value="<?= substr($session['endTime'], 0, 5) ?>" required class="w-full mb-6 px-3 py-2 border border-gray-300 rounded">

                    <input type="submit" value="Confirm Changes" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
                </form>
            </div>
        </div>
    </body>
</html>
