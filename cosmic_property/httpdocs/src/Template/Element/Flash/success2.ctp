<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<link href=<?php echo $this->Url->build("/assets/css/custom.css")?> rel="stylesheet">
<div class="success2_div" role="alert" onclick="$(this).fadeOut();return false;" >
    <p style="float: left; width: 90%;padding-left: 2%"><?= $message ?></p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right; margin-top: 10px;margin-right: 1%"></button>
</div>


