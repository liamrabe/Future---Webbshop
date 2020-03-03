<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";

	// Kolla om variabel db finns och är en instans av Database-klassen.
	if(isset($db)) {
		if(!$db instanceof Database) {
			$db = new Database();
		}
	}
	else {
		$db = new Database();
	}

	if($db->IsLoggedIn()) {
		$username = $db->GetUsername();
	}

?>
<div class="navbar">
	<ul class="navbar-wrapper">
		<div class="left">
			<li class="nav-item"><a href="/" class="nav-link">Hem</a></li>
			<li class="nav-item">
				<a href="/" class="nav-link">
					Översikt
					<span class="fas fa-angle-down icon-left"></span>
				</a>
				<ul class="nav-dropdown">
					<li class="dropdown-item">
						<a href="/" class="dropdown-link">
							Användare
						</a>
					</li>
					<li class="dropdown-item">
						<a href="/" class="dropdown-link">
							Gästbok
						</a>
					</li>
					<li class="dropdown-item">
						<a href="/" class="dropdown-link">
							Blogginlägg
						</a>
					</li>
					<li class="dropdown-item">
						<a href="/" class="dropdown-link">
							Kontakt
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<a href="/" class="nav-link">
					Verktyg
					<span class="fas fa-angle-down icon-left"></span>
				</a>
				<ul class="nav-dropdown">
					<li class="dropdown-item">
						<a href="/" class="dropdown-link">
							Nytt blogginlägg
						</a>
					</li>
				</ul>
			</li>
		</div>
	</ul>
</div>