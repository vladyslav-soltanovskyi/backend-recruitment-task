<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Backend/Full-stack recruitment task / Users Table</title>
  <link rel="stylesheet" href="assets/styles/css/styles.css">
</head>

<body>
  <?=$component('header')?>
  <main class="container mt-20">
    <?=$component('users-table', ['users' => $users]);?>
  </main>

  <script type="module" src="assets/js/users.page.js"></script>
</body>

</html>