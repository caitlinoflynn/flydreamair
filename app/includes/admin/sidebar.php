<div class="sidebar">
  <div class="profile"></div>
  <div class="circle" id="circle1"></div>
  <div class="circle" id="circle4"></div>
  <div class="list">
    <h1>List</h1>
    <ul>
      <li>Dashboard</li>
      <a href="<?php echo BASE_URL . '/admin/celebrities/' ?>">
          <li>Celebrities</li>
      </a>
      <a href="<?php echo BASE_URL . '/admin/seasons/' ?>">
          <li>Seasons</li>
      </a>
      <a href="<?php echo BASE_URL . '/admin/face-shapes/' ?>">
          <li>Face Shapes</li>
      </a>
      <li>Body Shapes</li>
      <li class="dark-mode">
        <form>
          <label>Dark Mode
            <input type="checkbox">
          </label>
        </form>
      </li>
    </ul>
  </div>
</div>