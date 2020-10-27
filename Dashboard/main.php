<!-- **************************************************************************
* Copyright 2020 Marshall Brown, Josiah Schmidt, Micah Withers
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or
* See the License for the specific language governing permissions and
* limitations under the License.
************************************************************************** -->

<!-- php file required to insert new lots into database (US 3.1) -->
<?php
session_start();
require 'dbConnect.php';
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;
require 'sql.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <!-- Overall page format -->
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<!-- Adjusts viewport to size of screen-->
		<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <!-- Link to CSS stylesheet -->
        <link rel="stylesheet", href="styles.css">
		<link href="https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap" rel="stylesheet">
    </head>

    <style media="screen">
        #lotTable {
            display: flex;
            margin-left: 10%;
            margin-right: 10%;
            height: 526.4px;
            overflow: auto;
        }
    </style>

    <body>
        <?php require 'navbar.php'; ?>

		<h1 id="home">Home</h1>
        <!-- US 5.3: JavaScript array to contain table values from db -->
        <div id="lotTable" class="">

        </div>

        <!-- Import JS functions -->
        <script type="module" defer>
            import * as Script from './scripts.js';

            // US 4.2, 5.3: Table of lot info from db
            <?php $lots = simpleSelect("
                            SELECT l.lotnum, customer, SUM(p.gross) gross,
                                SUM(p.tare) tare, (SUM(p.gross) - SUM(p.tare)) net,
                                status
                            FROM Lots AS l
                            INNER JOIN Pallets AS p
                            USING (lotnum)
                            GROUP BY (lotnum)
                        ");
            ?>
            var rows = <?php echo json_encode(get_rows($lots)); ?>;
            var fields = <a href="addLot.php"><?php echo json_encode(get_fields($lots))</a>?>;
            var headers = ["Lot", "Customer", "Gross", "Tare", "Net", "Status"];
            var tableId = "lotTable";
            Script.makeTable(tableId, fields, rows, headers, "lotnum");
            // Script.sortRows(rows, 'lotnum', false);
        </script>
    </body>
</html>
