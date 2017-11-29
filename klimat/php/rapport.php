<?php
   include('session.php');
?>
<!DOCTYPE html>
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
	<div id="user">
		<p>	User: Företag
			<form id="logout" align="right" style="float:right"name="form1" method="post" action="statistik.html">
				<label>
					<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
				</label>
			</form>
		</p>
	</div>
	<div id="wrapper">
		<a href="rapport.html">
			<div id="logo">
			</div>
		</a>

		<div id="menu">
			<ul>
				<a href="rapport.html">
					<li class="menuitem currentpage" >
						Rapport
					</li>
				</a>
				<a href="historik.html">
					<li class="menuitem">
						Historik
					</li>
				</a>
				<a href="statistik.html">
					<li class="menuitem">
						Statistik
					</li>
				</a>
				<a href="mina_sidor.html">
					<li class="menuitem">
						Mina Sidor
					</li>
				</a>
				<a href="kontakt.html">
					<li class="menuitem">
						Kontakt
					</li>
				</a>
			</ul>
		</div>
		<div id="content">
			<h1>
				Inventering av CO<sub>2</sub> utsläpp
			</h1>
			<p>
				År: <input type="text" name="Year" class="inputbox" style="float: none">
				<button class = "menubutton flatbutton" onclick = "alert('Rapport sparad')">
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<p id="outputbox" class="output"></p>
						</td>
					</tr>
					<tr>
						<td>Diesel</td>
						<td>
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
							<select>
								<option>
									m<sup>3</sup>
								</option>
								<option>
									L
								</option>
							</select>
						</td>
						<td><p id="outputbox" class="output"></p></td>
					</tr>
					<tr>
						<td>Diesel 24% förnybar</td>
						<td>
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
							<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
				</tbody >
			</table>
			<div id="m_krav">
				<h3>Ställs miljökrav vid inköp av fordon</h3>
				<p>
					<input class="radiobutton" type="radio" name="YesOrNo" value="Yes"> Ja
					<input class="radiobutton" type="radio" name="YesOrNo" value="No" style="margin-bottom: 20px"> Nej
				</p>

				<h4>Om ja beskriv krav:</h4>

				<textarea class="comments" rows="4" cols="50" name="comment" form="usrform"></textarea></td>
			</div>
			<div id="bio_krav">
				<h3>
					Biodrivmedel i köpta transporttjänster
				</h3>

				<p>Andel %
					<input  type="text" class="inputbox"/></p>
					<br>

					<p>Krav Ja/Nej</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo" value="No" style="margin-bottom: 20px"> Nej
					</p>
				</div>
				<div id="etc_krav">
					<h3>
						Andra miljökrav på  transporttjänster (t.ex. sparsamkörning eller energieffektivitet)
					</h3>
					<p>
						Krav Ja/Nej
					</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo" value="No" style="margin-bottom: 20px"> Nej
					</p>
					<p>
						Om ja beskriv krav:
					</p>
					<textarea class="comments" rows="4" cols="50" name="comment" form="usrform" style="margin-bottom: 20px"></textarea>
				</div>
				<div id="inkops_rese">
					<h3>
						Inköps- och resepolicy
					</h3>
					<p>
						Tillämpas inköpspolicyn för fordon
					</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo" value="No" style="margin-bottom: 20px"> Nej
					</p>
					<p>
						Tillämpas resepolicy
					</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo" value="No" style="margin-bottom: 20px"> Nej
					</p>
					<p>
						Eventuella kommentarer
					</p>
					<textarea class="comments" rows="8" cols="50"></textarea>
				</div>
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
								<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
								<p style="margin:5px">(m<sup>2</sup>)</p>
							</td>
						</tr>
						<tr>
							<td>
								Varav lokaler som hyrs ut
							</td>
							<td>
								<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
					<tbody id="stattable">
						<tr>
							<td>
								Olja
							</td>
							<td>
								<input  type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
								Fjärrvärme EF Kristianstad 2015
							</td>
							<td>
								<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
								<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
								<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
								<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
								ospecificerad el
							</td>
							<td>
								<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="inputbox"/>
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
				<input type="text" class="inputbox"/> <p style="margin-left: 2em;">kg Co2</p>

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
							<td><input type="text" class="inputbox"/></td>
						</tr>

					</tbody>

				</table>

				<button id="addrow">
					Ny resa
				</button>

				<div id="flygresor_comments">
					<h3>Övriga kommentarer</h3>



					<textarea class="comments"rows="8" cols="50">
					</textarea>
					<br>
					<button class = "menubutton flatbutton savebutton" onclick = "alert('Rapport sparad')">
						Spara
					</button>
					<button class = "menubutton flatbutton rensa">
						Rensa
					</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/rapport-script.js"></script>
</body>
</html>