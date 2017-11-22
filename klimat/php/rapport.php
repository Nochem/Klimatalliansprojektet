<html>
<head>
<style> tabel,th,{
	border: 1px solod black;
}
</style>
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
	include_once 'rapport_PHP.php';
?>
	<form id="logout" name="form1" method="post" action="rapport.html">
		<label class="logoutLblPos">
			<input name="submit2" type="submit" id="submit2" value="Log out">
		</label>
	</form>

	<div id="wrapper">
		<a href="rapport.html">
			<div id="logo" >
			</div>
		</a>

		<div id="menu">
			<ul>
				<li class="menuitem currentpage">
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

			</ul>
		</div>
		<div id="content">
			<div id="sidebar">
				<ul>
					<li class="menuitem">
						<a href="#transport">
							Transport
						</a>
					</li>
					<li class="menuitem">
						<a href="#lokalaprocesser">
							Lokala processer
						</a>
					</li>
					<li class="menuitem">
						<a href="#flygresor">
							Flygresor
						</a>
					</li>
				</ul>
			</div>
			<div id="stat">
				<h1>
					Inventering av CO<sub>2</sub> utsläpp
				</h1>
				<p>
					År: <span style="font-weight:bold;"> 2016 </span>
					<!-- <button class = "menubutton" onclick = "alert('Rapport sparad')">  
					<button type="submit" class = "menubutton">
						Spara
					</button>-->
				</p>
				<h1>
					<a name="transport">
						Transport
					</a>

				</h1>
				<table border="0">
					<thead>
						<tr>
							<th>Utsläppskälla</th>
							<th>Inköpt mängd</th>
							<th>Enhet</th>
							<th>Ton CO<sub>2</sub></th>
						</tr>
					</thead>
					<tbody id="stattable">
						<tr>
							<td>Bensin</td>
							<td>
								<form action="rapport.php" method="post">
									<input type="text" name="bensin" class="inputbox"/>	
										<input type="submit" name="submit" value="Skicka in rapport"/>
										
										<button type="submit" class = "menubutton">
											Spara
										</button>
					
								</form>
							</td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr>
							<td>Diesel</td>
							<td><input type="text" class="inputbox" /></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox" /></td>
						</tr>
						<tr>
							<td>Diesel 24% förnybar</td>
							<td><input  type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr>
							<td>Diesel Preem Evolution</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr>
							<td>RME</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr>
							<td>Etanol</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr>
							<td>Biogas</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr id="hvo">
							<td>HVO</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr id="miljo">
							<td>Miljömärkt el till fordon</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr id="ospec">
							<td>Ospecificerad el till fordon</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr id="else">
							<td>Övrigt drivmedel, ange vad</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr id="privat">
							<td>Privatbil (körning i tjänsten)</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
						<tr id="rental">
							<td>Hyrbil</td>

							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										m<sup>3</sup>
									</option>
								</select>
							</td>
							<td><input type="text" class="inputbox"/></td>
						</tr>
					</tbody>
				</table>

				<h1>
					<a name="lokalaprocesser">
						Lokala processer
					</a>
				</h1>

				<table>
					<thead>
						<tr>
							<th>Utsläppskälla</th>
							<th>Inköpt mängd</th>
							<th>Enhet</th>
							<th>Ton CO<sub>2</sub></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Lokaler som företaget äger
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>

							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								Varav lokaler som hyrs ut
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>

							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								Olja
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>m3</sup>
									</option>
								</select>

							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								Gasol
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>

							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								Fjärrvärme EF Kristianstad 2015
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>

							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								Halm
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>

							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								Pellets
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>
							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								Miljömärkt el
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>
							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
						<tr>
							<td>
								ospecificerad el
							</td>
							<td><input type="text" class="inputbox"/></td>
							<td>
								<select>
									<option>
										<sup>MWh</sup>
									</option>
								</select>
							</td>
							<td>
								<input type="text" class="inputbox"/>
							</td>
						</tr>
					</tbody>
				</table>
				<h1>
					<a name="flygresor">
						Flygresor
					</a>
				</h1>
				<table id="reportTable">
					<thead>
						<tr>
							<th>Från</th>
							<th>Till</th>
							<th>Längd km</th>
							<th>kg C02</th>
						</tr>
					</thead>
					<tr>
						<td><input type="text" class="inputbox"/></td>
						<td><input type="text" class="inputbox"/></td>
						<td><input type="text" class="inputbox"/></td>
						<td><input type="text" class="inputbox"/></td>
					</tr>
				</tbody>
			</table>
			<button id="addrow">
				Ny resa
			</button>
		
		
		</div>
	</div>
</div>
<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>
