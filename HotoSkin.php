<?php 
if ( ! defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}//end if

class SkinHoto extends SkinTemplate {
	/** Using Bootstrap */
	public $skinname = 'hoto';
	public $stylename = 'hoto';
	public $template = 'HotoTemplate';
	public $useHeadElement = true;

	/**
	 * initialize the page
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModuleScripts( 'skins.hoto' );
		
//		크기 자동 변경
		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' );
		$out->addMeta( 'description', 'HotoWiki' );
		$out->addMeta( 'keywords', 'wiki,HotoWiki,호토위키,' . $this->getSkin()->getTitle() );
//		크롬, 파이어폭스 OS, 오페라
		$out->addMeta('theme-color', '#F0AD4E');
//		윈도우 폰
		$out->addMeta('msapplication-navbutton-color', '#F0AD4E'); 
//		트위터 카드 시작
		$out->addMeta('twitter:card', 'summary');
		$out->addMeta('twitter:site', '@osawiki');
		$out->addMeta('twitter:title', $this->getSkin()->getTitle() );
		$out->addMeta('twitter:description', $out->mBodytext );
		$out->addMeta('twitter:creator', '@wikicocoa');
		$out->addMeta('twitter:image', 'https://www.osawiki.com/w/skins/hoto/img/twit.png');
		$out->addMeta('apple-mobile-web-app-capable', 'yes');
		$out->addMeta('apple-mobile-web-app-status-bar-style', '#F0AD4E');
		$out->addMeta('mobile-web-app-capable', 'Yes');
//		트위터 카드 완료
	}//end initPage

	/**
	 * prepares the skin's CSS
	 */
	public function setupSkinUserCss( OutputPage $out ) {
		global $wgSiteCSS;

		parent::setupSkinUserCss( $out );

		$out->addModuleStyles( 'skins.hoto' );
		
		$out->addStyle( 'hoto/font-awesome/css/font-awesome.min.css' );
		$out->addStyle( 'hoto/ionicons/css/ionicons.min.css' );
		
	}//end setupSkinUserCss
}

class HotoTemplate extends BaseTemplate {
	
	public $skin;

	public function execute() {
		global $wgRequest, $wgUser, $wgSitename, $wgSitenameshort, $wgCopyrightLink, $wgCopyright, $wgBootstrap, $wgArticlePath, $wgGoogleAnalyticsID, $wgSiteCSS;
		global $wgEnableUploads;
		global $wgLogo;
		global $wgTOCLocation;
		global $wgNavBarClasses;
		global $wgSubnavBarClasses;

		$this->skin = $this->data['skin'];
		$_TITLE = $this->getSkin()->getRelevantTitle();
		$action = $wgRequest->getText( 'action' );
		$url_prefix = str_replace( '$1', '', $wgArticlePath );
		$revid = $this->getSkin()->getRequest()->getText( 'oldid' );
		$_URITITLE = rawurlencode($_TITLE);

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();
		$this->html('headelement');
		?>
		<!--header start-->
<script type="text/javascript">(adsbygoogle = window.adsbygoogle || []).push({});</script>
    <header class="head-section">
      <div class="navbar navbar-default navbar-static-top container">
          <div class="navbar-header">
              <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse"
              type="button"><span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span></button> <a class="navbar-brand" href="<?php echo $this->data['nav_urls']['mainpage']['href']; ?>"><img src='/w/skins/hoto/img/head.png' width='200px'></a>
          </div>

          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
			  <li id="right-search">
					<form action="<?php $this->text( 'wgScript' ) ?>" id="searchform" role="search">
						<input style="display: inline-block;" class="form-control search" type="search" name="search" placeholder="Search" title=" Search <?php echo $wgSitename; ?> [ctrl-option-f]" accesskey="f" id="searchInput" autocomplete="off">
 						<input type="hidden" name="title" value="특수:검색">
 					</form>				
 				</li>
				<li><?php echo Linker::linkKnown( SpecialPage::getTitleFor( 'RecentChanges', null ), '<i class="fa fa-refresh" aria-hidden="true"></i>  <span id="mobile">바뀐 문서</span>'); ?></li>
				
				<li><?php echo Linker::linkKnown( SpecialPage::getTitleFor( 'Random', null ), '<i class="fa fa-random" aria-hidden="true"></i>  <span id="mobile">랜덤</span>'); ?></li>
				<?php $theMsg = 'toolbox';
				$theData = array_reverse($this->getToolbox()); ?>
				<li class="dropdown">
                   <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
                      "dropdown" data-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-plus-circle" aria-hidden="true"></i>  <span id="mobile">문서 도구</span> <i class="fa fa-angle-down"></i>
                      </a>
                      <ul aria-labelledby="<?php echo $this->msg($theMsg); ?>" role="menu" class="dropdown-menu" <?php $this->html( 'userlangattributes' ); ?>>
						<li id="t-upload"><a href="/wiki/%ED%8A%B9%EC%88%98:%EC%98%AC%EB%A6%AC%EA%B8%B0" title="파일 올리기 [Alt+Shift+u]" accesskey="u"><i class="fa fa-upload" aria-hidden="true"></i> 파일 올리기</a></li>
						<li id="t-re"><a href="/wiki/특수:필요한문서"><i class="fa fa-bell" aria-hidden="true"></i> 작성 필요</a></li>
						<li id="t-re"><a href="/wiki/특수:짧은문서"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> 짧은 문서</a></li>
						<li id="t-re"><?php echo '<a href="/wiki/특수:가리키는문서/'.$_URITITLE.'">';?><i class="fa fa-repeat" aria-hidden="true"></i> 역 링크</a></li>
						<li id="t-Special"><?php echo Linker::linkKnown( SpecialPage::getTitleFor( '특수문서', null ), '<i class="fa fa-cog" aria-hidden="true"></i> 특수 문서', array( 'title' => '특수 문서' ) ); ?></li>
						</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover="dropdown" data-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-external-link" aria-hidden="true"></i>  <span id="mobile">외부 페이지</span> <i class="fa fa-angle-down"></i>
					</a>
                      <ul aria-labelledby="<?php echo $this->msg($theMsg); ?>" role="menu" class="dropdown-menu" <?php $this->html( 'userlangattributes' ); ?>>
			<li id="t-re"><?php echo '<a href="//bbs.osawiki.com">';?><i class="fa fa-external-link" aria-hidden="true"></i> 오사위키 게시판</a></li>
			<li id="t-re"><?php echo '<a href="//status.osawiki.com">';?><i class="fa fa-external-link" aria-hidden="true"></i> 오사위키 상태 확인</a></li>
						</ul>
				</li>
				<li class="dropdown">
                   <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
                      "dropdown" data-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-book" aria-hidden="true"></i>  <span id="mobile">도움말</span> <i class="fa fa-angle-down"></i>
                      </a>
                      <ul aria-labelledby="<?php echo $this->msg($theMsg); ?>" role="menu" class="dropdown-menu" <?php $this->html( 'userlangattributes' ); ?>>
                      	<li id="t-help1"><?php echo Linker::linkKnown( Title::makeTitle( NS_HELP, '위키문법' ), '<i class="fa fa-book" aria-hidden="true"></i> 위키 문법', array( 'title' => '위키 문법에 대한 도움말을 보여줍니다.' ) ); ?></li>
						</ul>
				</li>
 
				
				<?php if ($wgUser->isLoggedIn()) {
				
				function loginBox() {
					global $wgUser, $wgRequest;
				}
				
					if ($wgUser->isLoggedIn()) {
							if ($wgUser->getEmailAuthenticationTimestamp()) {
							$email = trim($wgUser->getEmail());
							$email = strtolower($email);
							$email = md5($email) . "?d=identicon";
						}
						else {
							$result = mt_rand(1, 10000);
							$email = $result."?d=identicon&f=y";
						}
					}
				
            ?>
				<li class="dropdown">
					<a href="javascript:void(0);" class="dropdown-toggle" type="button" id="login-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo'<img style="width: 32px;" class="profile-img" src="https://secure.gravatar.com/avatar/'.$email.'" /></a>' ; ?></a>
					<ul class="dropdown-menu">
						<li id="pt-mypage"><?php echo Linker::linkKnown( Title::makeTitle( NS_USER, $wgUser->getName() ),'<i class="fa fa-user" aria-hidden="true"></i> ' . $wgUser->getName(), array( 'title' => '사용자 문서를 보여줍니다.' ) ); ?></li>
						<li id="pt-preferences"><?php echo Linker::linkKnown( SpecialPage::getTitleFor( 'preferences', null ), '<i class="fa fa-cog" aria-hidden="true"></i> 환경설정', array( 'title' => '환경설정을 불러옵니다.' ) ); ?></li>
						<li id="pt-watchlist"><?php echo Linker::linkKnown( SpecialPage::getTitleFor( 'watchlist', null ), '<i class="fa fa-bookmark" aria-hidden="true"></i> 주시 문서', array( 'title' => '주시문서를 불러옵니다.') ); ?></li>
						<li id="pt-mycontris"><?php echo Linker::linkKnown( SpecialPage::getTitleFor( 'Contributions', $wgUser->getName() ), '<i class="fa fa-pencil" aria-hidden="true"></i> 기여 문서', array( 'title' => '내 기여 목록을 불러옵니다.' ) ); ?></li>
						<li id="pt-notifications"><?php echo Linker::linkKnown( SpecialPage::getTitleFor( 'Notifications', null ), '<i class="fa fa-comment" aria-hidden="true"></i> 알림', array( 'title' => '알림 페이지로 이동합니다.' ) ); ?></li>
						<li id="pt-logout"><?php echo '<a href="/w/index.php?title=특수:로그아웃&returnto='.$_URITITLE.'"><i class="fa fa-times" aria-hidden="true"></i> 로그아웃</a>'; ?></li>
					</ul>
				</li>
				
				<?php } else {
					$result = mt_rand(1, 10000);
					$email = $result."?d=identicon&f=y";
				?>
				
				<li id="pt-login">
				<?php echo '<a href="/w/index.php?title=특수:로그인&returnto='.$_URITITLE.'"><i class="fa fa-sign-in" aria-hidden="true"></i> <span id="mobile">로그인</span></a>'; ?>
				</li>
				
				<?php } ?>

              </ul>
          </div>
      </div>
    </header>
    <!--header end-->
	
	<!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1><?php $this->html( 'title' ) ?></h1><?php $this->html( 'subtitle' ) ?></span>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
					<?php if ( count( $this->data['content_actions']) > 0 ) {
							foreach($this->data['content_actions'] as $pages) {
								echo '<li><a href="'.$pages['href'].'">'.$pages['text'].'</a></li>';
							}
							} ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
	<!--container start-->
    <section id="body">
	
	<div class="container">
	
	<div class="row">
	<div class="col-md-10 col-md-offset-1 mar-b-30">
	<?php if ( $this->data['sitenotice'] && $_COOKIE['alertcheck'] != "yes" ) { ?>
		<div id="sitenotice"><div style="margin-bottom: 10px;">공지<span style="float:right;"><div id="folding_2" style="display:block;">[<a href="javascript:void(0);" onclick="var f=document.getElementById('folding_1');var s=f.style.display=='block';f.style.display=s?'none':'block';this.className=s?'':'opened';var f=document.getElementById('folding_2');var s=f.style.display=='none';f.style.display=s?'block':'none';var f=document.getElementById('folding_3');var s=f.style.display=='block';f.style.display=s?'none':'block';">펼치기</a>]</div><div id="folding_3" style="display:none;">[<a href="javascript:void(0);" onclick="var f=document.getElementById('folding_1');var s=f.style.display=='block';f.style.display=s?'none':'block';this.className=s?'':'opened';var f=document.getElementById('folding_2');var s=f.style.display=='none';f.style.display=s?'block':'none';var f=document.getElementById('folding_3');var s=f.style.display=='block';f.style.display=s?'none':'block';">접기</a>]</div></a></span><div id="folding_1" style="display:none;"><br><?php $this->html( 'sitenotice' ) ?></div></div></div>
	<?php } ?>
	<!--상단 광고 -->
	<!--<ins id="noadsense" class="adsbygoogle" style="display:block;height:90px;" data-ad-client="ca-pub-6081569795236180" data-ad-slot="4545283356" data-ad-format="auto"></ins><br>-->
	<!--상단 광고 끝 -->
	<?php if ( $this->data['catlinks'] ) {
	$this->html( 'catlinks' );
	echo '<br>';
	} ?>
	<?php $this->html( 'bodytext' ); ?>
	<!--하단 광고 -->
	<!--<ins id="noadsense" class="adsbygoogle" style="display:block;height:90px;" data-ad-client="ca-pub-6081569795236180" data-ad-slot="4545283356" data-ad-format="auto"></ins><br>-->
	<!--하단 광고 끝 -->
<?php if ( $this->data['dataAfterContent'] ): ?>
				<div class="data-after-content">
				<!-- dataAfterContent -->
				<?php $this->html( 'dataAfterContent' ); ?>
				<!-- /dataAfterContent -->
				</div>
	<?php endif; ?>
	</div>
	</div>
	</div>
	</section>
	<div class="scroll-buttons">
		<a class="scroll-button" href="#"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
		<a class="scroll-bottom" href="#footer"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
	</div>
	<!--small footer start -->
    <footer class="footer-small" id="footer">
        <div class="container">
            <div class="row">
                  <div class="copyright">
                    <p><?php $this->html( 'copyright' ) ?></p>
					<a rel="license" href="//creativecommons.org/licenses/by-sa/4.0/"><img alt="크리에이티브 커먼즈 라이선스" style="border-width:0" class="pull-right" src="//i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a>
 					<a href="https://www.mediawiki.org"><img style="margin-right: 10px; " class="pull-right" src="https://www.mediawiki.org/static/images/poweredby_mediawiki_88x31.png"></a>
					<a href="//shapebootstrap.net"><img style="margin-right: 10px; margin-top:5px; margin-bottom: 20px;" class="pull-right" src="//shapebootstrap.net/templates/default/images/presets/preset1/logo.png"></a>	
					<!--<a href="//secure.comodo.com/ttb_searcher/trustlogo?v_querytype=W&v_shortname=CL1&v_search=https://www.hoto.us/&x=6&y=5"><img class="pull-right" src="/skins/hoto/img/comodo_secure_seal.png"></a>-->
                  </div>
            </div>
        </div>
    </footer>
     <!--small footer end-->
	<?php
		$this->html('bottomscripts');
		$this->html('reporttime');

		if ( $this->data['debug'] ) {
			$this->text( 'debug' );
		}
		?>
	</body>
		</html>
	<?php }
	
} ?>
