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

                $name = $_POST["companyName"];
                $tier = $_POST["tier"];
                $emailsSent = 0;

                $insertQuery = 'INSERT INTO company (name, emailsSent, tier) 
                                VALUES (:name, :emailsSent, :tier)';
                
                $stmt = $connection->prepare($insertQuery);
                $stmt->execute([
                    ':name' => $name,
                    ':emailsSent' => $emailsSent,
                    ':tier' => $tier
                ]);

                echo "<h1 class='text-xl font-bold mb-4'>Company \"$name\" added as a $tier sponsor!</h1>";
            ?>
        </div>
    </body>
</html>
