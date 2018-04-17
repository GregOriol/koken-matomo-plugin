<?php

class KokenMatomo extends KokenPlugin {

	function __construct()
	{
		$this->require_setup = true;
		$this->register_hook('before_closing_head', 'render');
	}

	function render()
	{
		echo <<<OUT
			<!-- Matomo -->
			<script type="text/javascript">
			  var _paq = _paq || [];
			  _paq.push(['trackPageView']);
			  _paq.push(['enableLinkTracking']);
			  (function() {
			    var u="{$this->data->url}";
			    _paq.push(['setTrackerUrl', u+'piwik.php']);
			    _paq.push(['setSiteId', '{$this->data->site_id}']);
			    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
			  })();
			  
			  var _paqCurrentUrl = location.href;
			  $(document).on('pjax:success', function (event) {
			    _paq.push(['setReferrerUrl', _paqCurrentUrl]);
			    _paqCurrentUrl = '' + window.location.href;
			    _paq.push(['setCustomUrl', _paqCurrentUrl]);
			    _paq.push(['setDocumentTitle', document.title]);

			    // remove all previously assigned custom variables, requires Matomo 3.0.2
			    //_paq.push(['deleteCustomVariables', 'page']); 
			    _paq.push(['setGenerationTimeMs', 0]);
			    _paq.push(['trackPageView']);
    
			    // make Matomo aware of newly added content
			    var content = $('.pjax-container-current');
			    _paq.push(['MediaAnalytics::scanForMedia', content]);
			    _paq.push(['FormAnalytics::scanForForms', content]);
			    _paq.push(['trackContentImpressionsWithinNode', content]);
			    _paq.push(['enableLinkTracking']);
			  });
			</script>
			<!-- End Matomo Code -->
OUT;
	}
}
