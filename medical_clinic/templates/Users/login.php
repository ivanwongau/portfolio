<body class="text-center " style="padding: top 0;">

<meta name="theme-color" content="#7952b3">

<div class="users form content form-signin lgform">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email and password') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password')
        ?>

    </fieldset>
    <?= $this->Form->button(__('Login', ['type' => 'submit', 'class' => "w-100 btn btn-lg btn-primary"])); ?>
    <?= $this->Form->end() ?>
</div>


<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>


<link href="/team19/webroot/bootstrap5.0/css/signin.css" rel="stylesheet">
