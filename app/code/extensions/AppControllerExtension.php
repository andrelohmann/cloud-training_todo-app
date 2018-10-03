<?php

class AppControllerExtension extends Extension {

	private static $release = 0;

	public function onBeforeInit(){

        $url = explode('/',$this->owner->request->getURL());

        // Set Requirements for all custom Controllers
        if(!in_array($url[0], array('admin', 'dev', 'interactive'))){

            i18n::set_default_locale('de_DE');

            Requirements::css("themes/bootstrap/css/bootstrap/yeti/bootstrap.min.css");
						//Requirements::css("//netdna.bootstrapcdn.com/bootswatch/3.3.6/paper/bootstrap.min.css");

            Requirements::css("themes/bootstrap/css/bootstrap/yeti/adjust.css");

						// http://daneden.github.io/animate.css/
						Requirements::css("themes/bootstrap/css/animate/animate.min.css");
						//Requirements::css("//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css");
						Requirements::css("themes/bootstrap/css/animate/animationdelay.css");

						//http://fortawesome.github.io/Font-Awesome/
						Requirements::css("themes/bootstrap/css/font-awesome/css/font-awesome.min.css");
						//Requirements::css("//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");

						//https://useiconic.com/open/
						Requirements::css("themes/bootstrap/css/open-iconic/css/open-iconic-bootstrap.min.css");
						//Requirements::css("//cdn.jsdelivr.net/open-iconic/1.1.0/font/css/open-iconic-bootstrap.min.css");

						//http://ionicons.com/
						Requirements::css("themes/bootstrap/css/ionicons/css/ionicons.min.css");
						//Requirements::css("//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css");

						// App CSS
						Requirements::css("app/css/app.css");

						// Load JQuery From bootstap theme
							Requirements::block(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
							Requirements::block(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.min.js');

						Requirements::javascript("themes/bootstrap/javascript/jquery/jquery.min.js");
						//Requirements::javascript("//code.jquery.com/jquery.min.js");

            // Require Javascript Layer
            $js = <<<JS
(function($) {
    $('#js-required').fadeOut('fast');
    $(document).on('click', 'a[href]:not([href^="mailto\\:"], [href^="\\#"], [data-confirm], [data-toggle], .no-fade)', function(){
        $('#js-required').fadeIn('fast');
    });
    $(document).on('click', 'a[data-confirm]', function(e){
        var r=confirm($(this).attr('data-confirm'));
        if(!r){
            e.preventDefault();
        }else{
            if(!$(this).hasClass('no-fade')) $('#js-required').fadeIn('fast');
        }
    });
    $(document).on('submit', function(){
        $('#js-required').fadeIn('fast');
    });
})(jQuery);
JS;
            Requirements::customScript($js, 'js-required');

						Requirements::javascript("themes/bootstrap/javascript/bootstrap/bootstrap.min.js");
						//Requirements::javascript("//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js");

            }

	}

  public function URLTopic(){
      $OwnerClass = get_class($this->owner);
      return (property_exists($OwnerClass, 'url_topic'))?$OwnerClass::$url_topic:'';
  }

  public function URLSegment(){
      $OwnerClass = get_class($this->owner);
      return (property_exists($OwnerClass, 'url_segment'))?$OwnerClass::$url_segment:'';
  }

  public function URLAction(){
      return $this->owner->getAction();
  }

  public function URLPath(){
      return $this->owner->URLSegment()."/".$this->owner->URLAction();
  }

  public function URLParameter($par){
      return $this->owner->request->param($par);
  }

  public function AbsoluteURLPath(){
      return Director::absoluteBaseURL().$this->owner->URLSegment()."/".$this->owner->URLAction();
  }

  // return Locale (e.g. de_DE, en_US)
  public function CurrentLocale(){
      return i18n::get_locale();
  }

  // return Language (e.g. de, en)
  public function CurrentLang(){
      return i18n::get_tinymce_lang();
  }

  /**
   * @param type $array
   * @return json object
   */
  public function jsonResponse($array){
      Controller::curr()->response->addHeader("Content-Type", "application/json");

      return json_encode($array);
  }

  public function CurrentYear(){
      return date("Y");
  }

  public function Timestamp(){
      return time();
  }

  public function BackURL() {
			// Don't cache the redirect back ever
			HTTP::set_cache_age(0);

			$url = null;

			// In edge-cases, this will be called outside of a handleRequest() context; in that case,
			// redirect to the homepage - don't break into the global state at this stage because we'll
			// be calling from a test context or something else where the global state is inappropraite
			if($this->owner->getRequest()) {
				if($this->owner->getRequest()->requestVar('BackURL')) {
					$url = $this->owner->getRequest()->requestVar('BackURL');
				} else if($this->owner->getRequest()->isAjax() && $this->owner->getRequest()->getHeader('X-Backurl')) {
					$url = $this->owner->getRequest()->getHeader('X-Backurl');
				} else if($this->owner->getRequest()->getHeader('Referer')) {
					$url = $this->owner->getRequest()->getHeader('Referer');
				}
			}

			if(!$url) $url = Director::baseURL();

			// absolute redirection URLs not located on this site may cause phishing
			if(Director::is_site_url($url)) {
				$url = Director::absoluteURL($url, true);
				return $url;
			} else {
				return false;
			}
  }

  public function PrevURL() {
      if(isset($_REQUEST['PrevURL'])) {
          return $_REQUEST['PrevURL'];
      }
  }

  public function redirectPrev(){
			// Don't cache the redirect back ever
			HTTP::set_cache_age(0);

			$url = null;

			// In edge-cases, this will be called outside of a handleRequest() context; in that case,
			// redirect to the homepage - don't break into the global state at this stage because we'll
			// be calling from a test context or something else where the global state is inappropraite
			if($this->owner->getRequest()) {
				if($this->owner->getRequest()->requestVar('PrevURL')) {
					$url = $this->owner->getRequest()->requestVar('PrevURL');
				}
			}

			if(!$url) $url = Director::baseURL();

			// absolute redirection URLs not located on this site may cause phishing
			if(Director::is_site_url($url)) {
				$url = Director::absoluteURL($url, true);
				return $this->owner->redirect($url);
			} else {
				return false;
			}

	}

	public function BackToAdmin(){
			if(Session::get('AdminLogin')) return true;
			else return false;
	}

	public function Release(){
			return Config::inst()->get('AppControllerExtension', 'release');
	}
}
