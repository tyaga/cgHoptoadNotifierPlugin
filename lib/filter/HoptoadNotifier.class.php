<?php 
/**
 * Filter for notifiying HopToad of any errors
 *
 * @author Chris Gratigny chrisg@ibethel.org
 * @version 1
 */
class HoptoadNotifier extends sfFilter
{
	
    /**
     * Execute filter
     *
     * @param FilterChain $filterChain The symfony filter chain
     */
    public function execute($filterChain)
    {
        // Only execute this filter once
        if ($this->isFirstCall() && $this->getEnabled() == true)
        {
            ServicesHoptoad::installHandlers($this->getApiKey(),$this->getEnvironment(),'curl');
		}
        // Next filter
        $filterChain->execute();
    }
	
	private function getApiKey() {
		return sfConfig::get('sf_hoptoad_api_key');
	}
	
	private function getEnvironment() {
		return sfConfig::get('sf_environment');
	}
	
	private function getEnabled() {
		return (sfConfig::get('sf_hoptoad_disabled') == true ? false : true);
	}
    

}
