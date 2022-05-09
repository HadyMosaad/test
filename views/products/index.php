<h1>Product CRUD</h1>

<p>
    <a href="/products/create" type="button" class="btn btn-sm btn-success">Add Product</a>
</p>
<form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form>

<form  method="post" action="/products/MassDelete" style="display: inline-block">

    <?php  foreach ($products as $i => $product) { ?>
        

            <div class="boxed">
                <?php if(($i+1) % 4 === 0) {
                    echo "<ul>";
                }?>
             <input class = "delete-checkbox" type="checkbox" name="checked[]" value=<?php echo $product['id']  ?>> </li>
             <li> <?php echo $product['sku'] ?></li>
             <li> <?php echo $product['price'] ?></li>
             <li> <?php echo $product['name'] ?></li>
                <li> <?php echo $product['weight'] ."Kg" ?></li>

              <?php if(($i+1) % 4 === 0) {
              echo "</ul>"; 
              }?>
            
            </div>
    <?php } ?>
    <button type="submit" class="btn btn-danger" >Mass Delete</button>
</form> 
<?php
echo  $_SERVER['REQUEST_METHOD'];
echo $ch ;
if ($_SERVER['REQUEST_METHOD'] == "POST"){ 
    echo 'you have added the following tools to your shopping cart:';
	foreach ($_POST['checked'] as $value) {
		echo " $value, ";
	}
}
if ( isset($_POST['submit']))
{
  if( !empty($_POST['type']));
     echo $_POST['type'];
}
?>
