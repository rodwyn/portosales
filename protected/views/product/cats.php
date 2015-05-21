<?php foreach ($cats as $row) { 
    $img = ($row->image)?$row->image:'categoria.jpg';
    ?>
    <li class="categoria" id="cat<?php echo $row->categoryid ?>" data-categoriaid="<?php echo $row->categoryid ?>" >
        <a href="#" title="" data-rel="colorbox" >
            <img width="100" height="100" src="<?php echo Yii::app()->request->baseUrl."/protected/cats/".$img; ?>" />
            <div class="text">
                <div class="inner" ><?php echo $row->name; ?></div>
            </div>
        </a>
    </li>
    <?php
}
?>
<script type="text/javascript">
    $(".categoria").click(function() {
        var cat = $(this).data("categoriaid");
        var cats = $.ajax({type: "GET", url: '?r=product/getproducts/categoryid/' + cat, async: false})
                .responseText;
        $("#producto-selector").html(cats);
    });
</script>