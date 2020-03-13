<?php

	$products = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/products"));
	$products = $products->products;

	if($db->IsLoggedIn()) {
		$user = $db->GetUser();
	}

?>
<div class="navbar small">
	<div class="navbar-bar">
		<button class="navbar-toggle" id="navbarToggle"><i class="fas fa-bars"></i></button>
	</div>
	<div class="navbar-wrapper" id="smallNav">
		<li class="nav-item"><a href="/" class="nav-link">Hem</a></li>
		<li class="nav-item"><a href="/about" class="nav-link">Om oss</a></li>
		<li class="nav-item"><a href="/blog" class="nav-link">Blogg</a></li>
		<li class="nav-item dropdown">
			<a class="nav-link">
				Våra produkter
				<span class="fas fa-angle-down icon-left"></span>
			</a>
			<ul class="nav-dropdown">
				<?php foreach($products->product as $product) { ?>
					<li class="dropdown-item">
						<a class="dropdown-link" href="/product/<?= $product->url; ?>">
							<?= $product->name; ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		</li>
		<li class="nav-item"><a href="/forum" class="nav-link">Forum</a></li>
		<li class="nav-item"><a href="/guestbook" class="nav-link">Gästbok</a></li>
		<?php if($db->IsLoggedIn()) { ?>
			<li class="nav-item dropdown">
				<a class="nav-link">
					<img class="avatar" src="<?= $user["avatar"]; ?>?s=20">
					<?= $user["username"]; ?>
					<span class="fas fa-angle-down icon-left"></span>
				</a>
				<ul class="nav-dropdown">
					<li class="dropdown-item">
						<a href="/my-posts" class="dropdown-link">
							Mina inlägg
						</a>
					</li>
					<li class="dropdown-item">
						<a href="/my-comments" class="dropdown-link">
							Mina kommentarer
						</a>
					</li>
					<?php if($db->IsAdmin()) { ?>
						<li class="dropdown-item">
							<a href="/admin/overview" class="dropdown-link">
								Admin översikt
							</a>
						</li>
					<?php } ?>
					<li class="dropdown-item">
						<a href="/profile/my-orders" class="dropdown-link">
							Mina beställningar
						</a>
					</li>
					<li class="dropdown-item">
						<a href="/signout" class="dropdown-link">Logga ut</a>
					</li>
				</ul>
			</li>
			<?php } else { ?>
			<li class="nav-item">
				<a href="/login" class="nav-link">
					Logga in
				</a>
			</li>
			<li class="nav-item">
				<a href="/register" class="nav-link">
					Bli medlem
				</a>
			</li>
		<?php } ?>
	</div>
</div>

<div class="navbar big">
	<ul class="navbar-wrapper">
		<div class="left">
			<li class="nav-item"><a href="/" class="nav-link">Hem</a></li>
			<li class="nav-item"><a href="/about" class="nav-link">Om oss</a></li>
			<li class="nav-item"><a href="/blog" class="nav-link">Blogg</a></li>
			<li class="nav-item">
				<a class="nav-link">
					Våra produkter
					<span class="fas fa-angle-down icon-left"></span>
				</a>
				<ul class="nav-dropdown">
					<?php foreach($products->product as $product) { ?>
						<li class="dropdown-item">
							<a class="dropdown-link" href="/product/<?= $product->url; ?>">
								<?= $product->name; ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			</li>
			<li class="nav-item"><a href="/forum" class="nav-link">Forum</a></li>
			<li class="nav-item"><a href="/guestbook" class="nav-link">Gästbok</a></li>
		</div>
		<div class="right">
			<?php if($db->IsLoggedIn()) { ?>
				<li class="nav-item">
					<a class="nav-link">
						<img class="avatar" src="<?= $user["avatar"]; ?>">
						<?= $user["username"]; ?>
						<span class="fas fa-angle-down icon-left"></span>
					</a>
					<ul class="nav-dropdown">
						<li class="dropdown-item">
							<a href="/my-posts" class="dropdown-link">
								Mina inlägg
							</a>
						</li>
						<li class="dropdown-item">
							<a href="/my-comments" class="dropdown-link">
								Mina kommentarer
							</a>
						</li>
						<?php if($db->IsAdmin()) { ?>
							<li class="dropdown-item">
								<a href="/admin/overview" class="dropdown-link">
									Admin översikt
								</a>
							</li>
						<?php } ?>
						<li class="dropdown-item">
							<a href="/profile/my-orders" class="dropdown-link">
								Mina beställningar
							</a>
						</li>
						<li class="dropdown-item">
							<a href="/signout" class="dropdown-link">Logga ut</a>
						</li>
					</ul>
				</li>
			<?php } else { ?>
				<li class="nav-item">
					<a href="/login" class="nav-link">
						Logga in
					</a>
				</li>
				<li class="nav-item">
					<a href="/register" class="nav-link">
						Bli medlem
					</a>
				</li>
			<?php } ?>
		</div>
	</ul>
</div>