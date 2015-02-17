<html>
<head>
	<title>Pokes</title>
</head>
<body>

<h1>Welcome, <?= $this->session->userdata('name') ?>!</h1>
<a href="logout">Logout</a>
<h2><?= $poke_count['COUNT(*)'] ?> people poked you!</h2>

<ul>
	<?php foreach($users_pokes as $user_poke){?>
	<li><?= $user_poke['poker'] ?> poked you <?= $user_poke['COUNT(*)'] ?> time(s).</li>
	<?}?>
</ul>

<h3>People you may want to poke:</h3>
<table>
	<thead>
		<th>Name</th>
		<th>Alias</th>
		<th>Email Address</th>
		<th>Poke History</th>
		<th>Action</th>
	</thead>
	<?php foreach($all_users as $all_user){?>
	<tr>
		<td><?=$all_user['name']?></td>
		<td><?=$all_user['alias']?></td>
		<td><?=$all_user['email']?></td>
		<td><?=$all_user['COUNT(user_id)']?> pokes</td>
		<td><form action="/poke/<?=$all_user['id']?>" method="post">
			<input type="submit" value="Poke!"></form></td>
	</tr>
	<?}?>
</table>

</body>
</html>