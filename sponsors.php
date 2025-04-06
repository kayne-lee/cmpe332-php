<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sponsors</title>
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

                if (isset($_POST['viewCompanyJobs']) && isset($_POST['companyName'])) {
                    $company = $_POST["companyName"];
                    echo "<h1 class='text-2xl font-bold mb-6'>Job Listings for ".$company.":</h1>";
                    $query = 'SELECT name, title, payRate, city, province FROM jobAd WHERE name="'.$company.'"';
                } else if (isset($_POST['viewAllJobs'])) {
                    echo "<h1 class='text-2xl font-bold mb-6'>All Sponsor Job Listings:</h1>";
                    $query = 'SELECT jobAd.name, title, payRate, city, province FROM jobAd JOIN company ON jobAd.name = company.name';
                } else {
                    echo "<p class='text-red-500'>Please select a company or choose to view all job ads.</p>";
                    $connection = NULL;
                    exit;
                }
                $result = $connection->query($query);
            ?>

            <table class="w-full max-w-4xl border border-gray-400 bg-white rounded shadow">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Company</th>
                        <th class="p-2 border">Job Title</th>
                        <th class="p-2 border">Pay Rate</th>
                        <th class="p-2 border">City</th>
                        <th class="p-2 border">Province</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch()) {
                                echo "<tr>
                                        <td class='p-2 border'>".$row['name']."</td>
                                        <td class='p-2 border'>".$row['title']."</td>
                                        <td class='p-2 border'>$".$row['payRate']."</td>
                                        <td class='p-2 border'>".$row['city']."</td>
                                        <td class='p-2 border'>".$row['province']."</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='p-4 text-center text-gray-500'>No job ads available for this sponsor.</td></tr>";
                        }

                        $connection = NULL;
                    ?>
                </tbody>
            </table>
        </div>

    </body>
</html>
