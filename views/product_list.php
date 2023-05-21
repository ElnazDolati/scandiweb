<form id='delete-form' method='POST' action='/mass-delete'>
    <div id='product-nav' style='
    display: grid;
    grid-template-columns: 800px 1fr 2fr;
    gap: 10px;
    margin: 10px;
    padding-block-end: 10px;
    border: solid;
    border-width: 0 0 2px 0;
    border-color: black;
    '>
        <h3>Product list</h3>
        <button type='button'
         id='add-product-btn'
         onclick="redirectAddProduct()" 
         class="btn btn-primary"
         >ADD</button>
        <button type='submit' id='delete-product-btn' class="btn btn-primary">MASS DELETE</button>
    </div>
    <div id='product-container' 
    style='display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 10px;
            padding:10px
            '>
        <?php
        if ($allModels) {
            foreach ($allModels as $model) {
                echo sprintf(
                    '<div class="card">
                <input type="checkbox" 
                    value ="0"
                    class="delete-checkbox"
                    id="id%s"
                    name="%s"
                    onclick= "changeCheckbox(this)"
                    style="align-self: start; margin: 16px;" />
                <div class="card-body">
                    <div class="card-text" style="display: flex; flex-direction:column; align-items:center">
                    <p class="sku-text">
                        %s
                    </p>
                    <p class="name-text">
                        %s
                    </p>
                    <p class="price-text">
                        %s $
                    </p>
                ',
                    $model->id,
                    $model->id,
                    $model->sku,
                    $model->name,
                    $model->price
                ) . sprintf(
                    '
                    <p class="extra-text">
                        %s
                    </p>
                    </div>
                </div>
            </div>',
                    $model
                );
            }
        }

        ?>

    </div>
</form>
<div id='footer-block' style='width:79%;
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
    $('#delete-form').on('submit',function(){
        if($("input.delete-checkbox:checked").val() === undefined){
            return false;
        }
        return true;
    })
    function onDeleteSubmit(e){
        e.preventDefault();

    }
    function redirectAddProduct() {
        window.location.replace('/add-product');
    }

    function changeCheckbox(item) {
        item.checked ? $(item).val(1) : $(item).val(0);
    }
</script>