<div class="sideBar">
    <!-- This section gets pushed to the top-->
    <div class="sideBar__section">
      <div class="sideBar__item is-side-bar-item-selected">Inbox</div>
      <div class="sideBar__item">Contacts</div>
      <div class="sideBar__item">Account</div>
    </div>
    <!-- This section gets pushed to the bottom-->
    <div class="sideBar__section">
      <div class="sideBar__item">Change theme</div>
      <div class="sideBar__item">Legal</div>
    </div>
  </div>
  <Style>
    .sideBar {
  /**
   * This container orders items according to flexbox
   * rules. By default, this would arrange its children
   * horizontally. However, the next property...
   */
  display: flex;

  /**
   * ...sets the main axis to be vertical instead of
   * horizontal, so now the children are laid out
   * vertically, from top to bottom.
   */
  flex-direction: column;

  /**
   * It will also put as much space as possible
   * between its children, with the children at either end
   * laying flush against the container's edges.
   */
  justify-content: space-between;

  height: 300px;
  width: 150px;
  border-right: 1px solid #D7DBDD;
  background-color: #FCFDFD;
  padding: 10px;
}

  .sideBar__item {
    cursor: pointer;
    padding: 5px 10px;
    color: #16A2D7;
    font-size: 12px;
  }

  .sideBar__item.is-side-bar-item-selected {
    background-color: #EEF3F5;
    border-radius: 4px;
  }
  </Style>
  <script>
    var $sideBarItems = $('.sideBar .sideBar__item');

$sideBarItems.click(function(event) {
  var selectedClass = 'is-side-bar-item-selected';
  $sideBarItems.removeClass(selectedClass);
  $(event.target).addClass(selectedClass);
});
  </script>
