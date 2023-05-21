
<div class='formWrapper' style='max-width: 500px; padding-block: 50px;'>
<?php $form = \app\core\form\Form::begin('/add-product', "POST", 'product_form') ?>
<div id='product-nav' style='
    width:1200px;
    display: grid;
    grid-template-columns: 900px 1fr 1fr;
    gap: 10px;
    margin: 10px;
    padding-block-end: 10px;
    border: solid;
    border-width: 0 0 2px 0;
    border-color: black;
    '>
        <h3>Product list</h3>
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" onclick="redirectHome()" class="btn btn-primary">Cancel</button>
</div>
<?php echo $form->field($model, 'sku') ?>
<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'price') ?>
<?php echo $form->field($model,'')->dropdown() ?>
<input type="hidden" id="type" name="type"/>
<div id="form-attribute-section">
</div>
<?php echo \app\core\form\Form::end() ?>
</div>
<div id='footer-block' style='width:1200px;
    display: flex;
    flex-direction:column;
    margin: 10px;
    padding-block-end: 10px;
    border: solid;
    border-width: 2px 0 0 0;
    border-color: black;
    '>
    <p style="align-self:center; padding-block-start: 10px;">Scandiweb Test assignment</p>
</div>
<script>
function redirectHome()
{
    window.location.replace('/');
}


$("#productType").on("change",function (){

    $('#type').val($(this).val());
    $.ajax({
        url:"add-attribute-section",
        method: "POST",
        data: {
            'type': $(this).val()
        }
    }).then(function(data){
        $("#form-attribute-section").html(data.form);
    });
})

</script>