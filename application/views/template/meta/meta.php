<!doctype html>
<?php $item_scope = isset($item_scope) ? $item_scope : 'WebPage'; ?>

<html itemscope itemtype="<?php echo PROTOCOL ?>://schema.org/<?php echo $item_scope ?>" lang="en">
<head>

<?php // see  @urzr_loader_helper()
load_template_view($meta_doctype);




load_template_view($meta_css);

?>
</head>
