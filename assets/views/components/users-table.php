<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Username</th>
      <th>Email</th>
      <th>Address</th>
      <th>Phone</th>
      <th>Company</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <td><?=$user['name'];?></td>
        <td><?=$user['username'];?></td>
        <td><?=$user['email'];?></td>
        <td>
          <?=$user['address']['street'];?>,
          <?=$user['address']['zipcode'];?>
          <?=$user['address']['city'];?>
        </td>
        <td><?=$user['phone'];?></td>
        <td><?=$user['company']['name'];?></td>
        <td><button class="button button-secondary delete-btn" data-id="<?=$user['id'];?>">Remove</button></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>