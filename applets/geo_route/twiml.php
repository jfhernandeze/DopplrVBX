<?php
require_once(dirname(__FILE__) . '/../../lib/dopplr.php');

$user = OpenVBX::getCurrentUser();
$dopplr_token = PluginData::get("dopplr_token_{$user->id}", "");

$dopplr = new Dopplr($dopplr_token);
$response = new Response();

if($dopplr->travel_today()) {
  $response->addRedirect(AppletInstance::GetDropZoneUrl('in_transit'));
} else if($dopplr->at_home) {
  $response->addRedirect(AppletInstance::GetDropZoneUrl('at_home'));
} else {
  $response->addRedirect(AppletInstance::GetDropZoneUrl('on_the_road'));
}

$response->Respond();