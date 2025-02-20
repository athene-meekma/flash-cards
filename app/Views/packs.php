<button type="button" class="btn btn-info add-button" data-bs-toggle="modal" data-bs-target="#addPack">New Pack</button>

<div class="col-lg-6" style="margin: auto">
  <ul class="list-group ">
    <li class="list-group-item list-group-item-info">
      <h3 class="list-group-item-heading">Your Packs</h3>
    </li>
    <?php
      foreach($packs as $pack){
        echo '<a href="/pack/'.$pack['id'].'" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">';
        echo $pack['name'];
        echo '<span class="badge bg-info rounded-pill">'.$pack['cardCount'].'</span>';
        echo '</a>';
      }
    ?>
  </ul>
</div>
<div class="modal fade" id="addPack" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/pack/create" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Flash Card Pack</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="packName" class="form-label">Pack Name</label>
            <input type="text" class="form-control" id="packName" name="packName" maxlength="255" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>