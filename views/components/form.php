<form method="POST" action="<?= $path ?>">
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Usuário</label>
        <div class="col-sm-10">
            <input type="text" name="usuario" class="form-control" id="staticEmail" value="">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputPassword">
        </div>
    </div>

    <input type="hidden" name="ts" value="<?= $ts ?>">
    <input type="hidden" name="sn" value="<?= $sn ?>">
    <input type="hidden" name="mac" value="<?= $mac ?>">
    <input type="hidden" name="mac" value="<?= $xtm ?>">
    <input type="hidden" name="mac" value="<?= $redirect ?>">

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Enviar</button>
    </div>
</form>