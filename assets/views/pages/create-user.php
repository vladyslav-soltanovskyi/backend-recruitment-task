<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Backend/Full-stack recruitment task / Create User</title>
  <link rel="stylesheet" href="assets/styles/css/styles.css">
</head>

<body>
  <?=$component('header')?>
  <main class="container">
    <h2 class="text-center">Create User</h2>
    <?=$component('create-user-form');?>
  </main>

  <script type="module" src="assets/js/create-user.page.js"></script>
</body>

</html>