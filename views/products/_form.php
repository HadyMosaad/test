
<?php //if (!empty($errors)): ?>
<!--    <div class="alert alert-danger">-->
<!--        --><?php //foreach ($errors as $error): ?>
<!--            <div>--><?php //echo $error ?><!--</div>-->
<!--        --><?php //endforeach; ?>
<!--    </div>-->
<?php //endif; ?>
<script>
function prodType(prod ){
  var acmeAttributes = document.getElementById("Disk");
  var warPeaceAttributes = document.getElementById("Book");
  var chairAttributes = document.getElementById("Furniture");

    acmeAttributes.style.display="none";
  warPeaceAttributes.style.display="none";
  chairAttributes.style.display="none";
  //value
  if(prod=="Disk"){
    acmeAttributes.style.display="block";
  }else if(prod=="Book"){
    warPeaceAttributes.style.display="block";
  }else if(prod=="Furniture"){
  chairAttributes.style.display="block";
  }

} </script>
<form method="post" id ="product_form" enctype="multipart/form-data">
    <div class="form-group">
        <label>Product sku</label>
        <input type="text"  id ="sku" name="sku" class="form-control" value="<?php echo $product['sku'] ?>">
    </div>
    <div class="form-group">
        <label>Product name</label>
        <textarea class="form-control" id ="name" name="name"><?php echo $product['name'] ?></textarea>
    </div>
    <div class="form-group">
        <label>Product price</label>
        <input type="number" step=".01" id ="price" name="price" class="form-control" value="<?php echo $product['price'] ?>">
    </div>

<select name="switcher" id="productType" onChange="prodType(this.value);">
<option value="">Choose Switcher</option>
<option value="Disk"> DVD</option>
<option value="Book"> Book  </option>
<option value="Furniture"> Furniture  </option>
</select>
<div class="fieldbox" id="Disk">
                  <label>Size</label>
                  <input type="text" id="size" name="size" value="">
                </div>

                <div class="fieldbox" id="Book">
                  <label>Weight</label>
                  <input type="text" id ="weight" name="weight" value="">
                </div>

                <div class="fieldbox" id="Furniture">
                  <label>Length</label>
                  <input type="text" id ="length" name="length" value=""><br>
                 <label>Width</label>
                <input type="text" id="width" name="width" value=""><br>
                    <label>height</label>
                    <input type="text" id ="height" name="height" value=""><br>
                </div>
<input class="btn btn-sm btn-success" type="submit" value ="Save" name="submit" >


</form>
<p>
    <a href="/" type="button" class="btn btn-sm btn-secondary">Cancel</a>
</p>
