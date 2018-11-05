import Errors from "./Errors";

class Panels{
    constructor(wizard){
        this.wizard = wizard;
        this.panelWidth = this.wizard.offsetWidth;
        this.panelsContainer = this.getPanelsContainer();
        this.panels = this.getPanels();
        this.currentStep = 0;

        this.updatePanelsPosition(this.currentStep);
        this.updatePanelsContainerHeight();
    }

    getCurrentPanelHeight(){
        return `${this.getPanels()[this.currentStep].offsetHeight}px`;
    }

    getPanelsContainer(){
        return this.wizard.querySelector('.panels');
    }

    getPanels(){
        return this.wizard.getElementsByClassName('panel');
    }

    updatePanelsContainerHeight(){
        this.panelsContainer.style.height = this.getCurrentPanelHeight();
    }

    updatePanelsPosition(currentStep){
        const panels = this.panels;
        const panelWidth = this.panelWidth;

        for (let i = 0; i < panels.length; i++) {
            panels[i].classList.remove(
                'movingIn',
                'movingOutBackward',
                'movingOutFoward'
            );

            if(i !== currentStep){
                if(i < currentStep) panels[i].classList.add('movingOutBackward');
                else if( i > currentStep ) panels[i].classList.add('movingOutFoward');
            }else{
                panels[i].classList.add('movingIn');
            }
        }

        this.updatePanelsContainerHeight();
    }

    setCurrentStep(currentStep){
        this.currentStep = currentStep;
        this.updatePanelsPosition(currentStep);
    }
}

export default Panels;