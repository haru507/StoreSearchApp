<header class="fix-01">居酒屋検索ガチャ
  <div class="hamburger" id="js-hamburger">
    <span class="hamburger__line hamburger__line--1"></span>
    <span class="hamburger__line hamburger__line--2"></span>
    <span class="hamburger__line hamburger__line--3"></span>
  </div>

  <nav class="global-nav">
    <ul class="global-nav__list">
      <li class="global-nav__item"><a href="../index.php">トップ (説明)</a></li>
      <li class="global-nav__item"><a href="../components/main.php">メイン (ガチャ)</a></li>
      <?php
        if( isset($_SESSION['EMAIL']) ){
          echo "<li class='global-nav__item'><a href='../signs/signOut.php'>サインアウト</a></li>";
          echo "<li class='global-nav__item'><a href='../components/history.php'>履歴確認</a></li>";
        }else {
          echo "<li class='global-nav__item'><a href='../signs/signUp.php'>サインアップ</a></li>";
          echo "<li class='global-nav__item'><a href='../signs/signIn.php'>サインイン</a></li>";
          
        }
      ?>      
      
    </ul>
  </nav>
  <div class="black-bg" id="js-black-bg"></div>
</header>