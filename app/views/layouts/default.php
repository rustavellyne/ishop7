<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?= $head['title'] ?? '' ?> </title>
    
    <?php if (!empty($meta)): ?>
        <?php foreach($meta as $tag): ?>
            <meta name="<?= $tag['name'] ?>" content="<?= $tag['content'] ?>"/>
        <?php endforeach; ?>
    <?php endif; ?>
    
  </head>
  <body>
      <h1>Default Layout</h1> 
      
      <?= $content ?? '' ?> 
  </body>
</html>

