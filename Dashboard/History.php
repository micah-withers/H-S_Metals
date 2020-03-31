<!-- **************************************************************************
* Copyright 2020 Marshall Brown, Josiah Schmidt, Micah Withers
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or
* See the License for the specific language governing permissions and
* limitations under the License.
************************************************************************** -->
<?php require 'search.php' ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Lot History</title>
		 <link rel="stylesheet", href="styles.css">
	</head>
	<body>
		 <div class="container">
            <!-- Taskbar -->
            <button onClick="location.href='main.html';">Home</button>
            <button id="highlight">Lot History</button>
            <button onClick="location.href='reports.html';">Reports</button>
            <button onClick="location.href='customers.html';">Customers</button>
        	<button onClick="location.href='accounts.html';">Accounts</button>

            <!-- Search bar -->
            <form action="" method="post">
                Search:  <input type="text" name="user_input" />
            <form/>
			<a href="../LoginPage/login.html">Logout</a>

		</div>

		<h1>Lot History</h1>
        <!-- Results of search -->
        <?php if (isset($_POST["user_input"])) ?>
            <h2>Results</h2>
        <table>
				<tr>
				<th> id </th>
				<th> name </th>
				<th> email </th>
				</tr>
            <?php 
			$conn = mysqli_connect("localhost", "mwithers", "2270410", "HandSMetals");
			if($conn-> connect_error){
				die("connection failed:" . $conn-> connect_error);
			}
			
			$sql = "SELECT id, name, email from MyGuests";
			$result = $conn-> query($sql);
			
			if($result-> num_rows > 0){
				while($row = $result-> fetch_assoc()){
					echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"]. "</td></tr>";
				}
				echo "</table>";
			}
			
			$conn-> close();
			
			?>
		
		


        <!-- Link to JavaScript source file -->
        <script src="scripts.js"> </script>
	</body>
</html>
