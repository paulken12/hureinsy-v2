import Panels from './Panels';
import Steps from './Steps';

class Wizard{
    constructor(obj){
        this.wizard = obj;
        this.panels = new Panels(this.wizard);
        this.steps = new Steps(this.wizard);
        this.stepsQuantity = this.steps.getStepsQuantity();
        this.currentStep = this.steps.currentStep;

        this.concludeControlMoveStepMethod = this.steps.handleConcludeStep.bind(this.steps);
        this.wizardConclusionMethod = this.handleWizardConclusion.bind(this);
    }

    updateButtonsStatus(){
        if(this.currentStep === 0)
            this.previousControl.classList.add('disabled');
        else
            this.previousControl.classList.remove('disabled');
    }

    updtadeCurrentStep(movement){
        this.currentStep += movement;
        this.steps.setCurrentStep(this.currentStep);
        this.panels.setCurrentStep(this.currentStep);

        this.handleNextStepButton();
        this.updateButtonsStatus();
    }

    handleNextStepButton(){
        if(this.currentStep === this.stepsQuantity - 1){
            this.nextControl.innerHTML = 'Conclude!';

            this.nextControl.removeEventListener('click', this.nextControlMoveStepMethod);
            this.nextControl.addEventListener('click', this.concludeControlMoveStepMethod);
            this.nextControl.addEventListener('click', this.wizardConclusionMethod);
        }else{
            this.nextControl.innerHTML = 'Next';

            this.nextControl.addEventListener('click', this.nextControlMoveStepMethod);
            this.nextControl.removeEventListener('click', this.concludeControlMoveStepMethod);
            this.nextControl.removeEventListener('click', this.wizardConclusionMethod);
        }
    }

    handleAdd()
    {
        this.addControl.addEventListener('click', this.addControlMethod);
    }

    handleWizardConclusion(){
        this.wizard.classList.add('completed');
    };

    addControls(previousControl, nextControl, addControl){
        this.previousControl = previousControl;
        this.nextControl = nextControl;
        this.addControl = addControl;
        this.previousControlMoveStepMethod = this.moveStep.bind(this, -1);
        this.nextControlMoveStepMethod = this.moveStep.bind(this, 1);
        this.addControlMethod = this.moveStep.bind(this, 0);

        previousControl.addEventListener('click', this.previousControlMoveStepMethod);
        nextControl.addEventListener('click', this.nextControlMoveStepMethod);
        addControl.addEventListener('click', this.addControlMethod);

        this.updateButtonsStatus();
        this.handleAdd();
    }

    moveStep(movement){
        if(this.validateMovement(movement)){
            this.updtadeCurrentStep(movement);
            this.steps.handleStepsClasses(movement);
        }else{
            throw('This was an invalid movement');
        }
    }

    validateMovement(movement){
        const forwardMov = movement > 0 && this.currentStep < this.stepsQuantity - 1;
        const backMov = movement < 0 && this.currentStep > 0;

        return forwardMov || backMov;
    }
}

export default Wizard;
