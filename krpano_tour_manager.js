class KRPanoTourManager {

  constructor(krpano){
    this.krpano = krpano;
    this.initializeEvents();
  }

  //Set the onscene loaded event
  initializeEvents() {
    var self = this;
    this.krpano.set('events.onnewpano', function(){ self.onNewPano(); });
  }

  onNewPano() {
    var currentScene = this.krpano.get('xml.scene');
    this.updateContent(currentScene);
  }

  updateContent(scene) {
    jQuery(".krpano-tour-content").hide();
    jQuery("#"+scene).show();
  }
}
