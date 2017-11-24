<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Rapport
	</title>
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link rel="stylesheet" type="text/css" href="../css/rapport-style.css">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
<?php
	include_once('rapport_php.php');
?>
	<div id="wrapper">
		<a href="rapport.html">
			<div id="logo">
			</div>
		</a>

		<div id="menu">
			<ul>
				<li class="menuitem currentpage" >
					<a href="rapport.html">
						Rapport
					</a>
				</li>
				<li class="menuitem">
					<a href="historik.html">
						Historik
					</a>
				</li>
				<li class="menuitem">
					<a href="statistik.html">
						Statistik
					</a>
				</li>
				<li class="menuitem">
					<a href="mina_sidor.html">
						Mina Sidor
					</a>
				</li>
				<li class="menuitem">
					<a href="kontakt.html">
						Kontakt
					</a>
				</li>
				<li>
					<form  id="logout" name="form1" method="post" action="rapport.html">
						<label>
							<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
						</label>
					</form>
				</li>
			</ul>
		</div>
		<div id="content">
			<h1>
				Inventering av CO<sub>2</sub> utsläpp
			</h1>
			<p>
				År: <span style="font-weight:bold;"> 2016 </span>
				
				<button name="submit" form="rapport" class = "menubutton flatbutton" onclick = "alert('Rapport sparad')">
					Spara
				</button>
				<button class = "menubutton flatbutton rensa">
					Rensa
				</button>
			</p>
			<h1>
				<a name="transport">
					Transport
				</a>
			</h1>
			<table>
			<thead>
				<tr>
					<th>Utsläppskälla</th>
					<th>Inköpt mängd</th>
					<th>Ton CO<sub>2</sub></th>
				</tr>
			</thead>
			<tbody id="stattable">
				<tr>
					<td>Bensin</td>
					<td>
					<form name="rapport" action="rapport.php" method="post" id="rapport">
						<input type="text" name="bensin" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>Diesel</td>
					<td>
						<input type="text" name="diesel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr>
					<td>Diesel 24% förnybar</td>
					<td>
						<input type="text" name="diesel24" nameonkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>Diesel Preem Evolution</td>
					<td>
						<input type="text" name="dieselPreemEvo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr>
					<td>RME</td>
					<td>
						<input type="text" name ="rme" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr>
					<td>Etanol</td>
					<td>
						<input type="text" name="etanol" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr>
					<td>Biogas</td>
					<td>
						<input type="text" name="biogas" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr id="hvo">
					<td>HVO</td>
					<td>
						<input type="text" name="hvo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr id="miljo">
					<td>Miljömärkt el till fordon</td>
					<td>
						<input type="text" name="miljoMarktElFordon" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								MWh
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr id="ospec">
					<td>Ospecificerad el till fordon</td>
					<td>
						<input type="text" name="ospecElFordon" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								MWh
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr id="else">
					<td>Övrigt drivmedel, ange vad </td>
					<td>
						<input type="text" name="ovrigtDrivmedel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr id="privat">
					<td>Privatbil (körning i tjänsten)</td>
					<td>
						<input type="text" name="bilTjanst" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
							<option>
								MWh
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
				<tr id="rental">
					<td>Hyrbil</td>
					<td>
						<input type="text" name="hyrbil" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								m<sup>3</sup>
							</option>
							<option>
								L
							</option>
							<option>
								MWh
							</option>
						</select>
					</td>
					<td><p class="output"></p></td>
				</tr>
			</tbody>
		</table>
		<h3>Övriga kommentarer</h3>
		<textarea class="comments" rows="8" cols="50">
		</textarea>
		<h1>
			<a name="lokalaprocesser">
				Lokala processer
			</a>
		</h1>
		<table>
			<thead>
			</thead>
			<tbody>
				<tr>
					<td>
						Lokaler som företaget äger
					</td>
					<td>
						<input type="text" name="lokalerAgare" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<p style="margin:5px">(m<sup>2</sup>)</p>
					</td>
				</tr>
				<tr>
					<td>
						Varav lokaler som hyrs ut
					</td>
					<td>
						<input type="text" name="lokalerHyrUt" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<p style="margin:5px">(m<sup>2</sup>)</p>
					</td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th>Utsläppskälla</th>
					<th>Inköpt mängd</th>
					<th>Ton CO<sub>2</sub></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Olja
					</td>
					<td>
						<input type="text" name="olja" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								<sup>m3</sup>
							</option>
						</select>

					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>
						Gasol
					</td>
					<td>
						<input type="text" name="gasol" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								<sup>MWh</sup>
							</option>
						</select>

					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>
						Fjärrvärme (EF i Kristianstad 2015)
					</td>
					<td>
						<input type="text" name="fjarrvarmeEfKristianstad2015" name="fjarrvarmeonkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								<sup>MWh</sup>
							</option>
						</select>

					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>
						Halm
					</td>
					<td>
						<input type="text" name="halm" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								<sup>MWh</sup>
							</option>
						</select>

					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>
						Pellets
					</td>
					<td>
						<input type="text" name="pellets" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								<sup>MWh</sup>
							</option>
						</select>
					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>
						Miljömärkt el
					</td>
					<td>
						<input type="text" name="miljoMarktEl" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								<sup>MWh</sup>
							</option>
						</select>
					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
				<tr>
					<td>
						Ospecificerad el
					</td>
					<td>
						<input type="text" name="ospecEl" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
						<select>
							<option>
								<sup>MWh</sup>
							</option>
						</select>
					</td>
					<td>
						<p class="output"></p>
					</td>
				</tr>
			</tbody>
		</table>

		<h3>Övriga kommentarer</h3>
		<textarea class="comments" rows="8" cols="50">
		</textarea>
		<h1>
			<a name="flygresor">
				Flygresor
			</a>
		</h1>
		<h2>Totala flygutsläpp</h2>
		<input type="text" name="totFlygutslapp" class="inputbox"/> <p style="margin-left: 2em;">kg Co2</p>
	
		<table id="reportTable">
			<thead>
				<tr>
					<th>Från</th>
					<th>Till</th>
					<th>Längd km</th>
					<th>kg C02</th>
				</tr>

			</thead>
			<tbody>

				<tr>
					<td><input type="text" class="inputbox"/></td>
					<td><input type="text" class="inputbox"/></td>
					<td><input type="text" class="inputbox"/></td>
					<td><input type="text" name="flygresorKgCO2" class="inputbox"/></td>
				</tr>

			</tbody>
		</table>

		<button id="addrow">
			Ny resa
		</button>
		<br>

		<h3>Övriga kommentarer</h3>
		<textarea class="comments"rows="8" cols="50">
		</textarea>
		<br>
		<button name="submit" form="rapport" class = "menubutton flatbutton" style="left:530px"  onclick = "alert('Rapport sparad')">
			Spara
		</button>
		<button class = "menubutton flatbutton rensa" style="left:530px">
			Rensa
		</button>
		</form>
	</div>
</div>
<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>