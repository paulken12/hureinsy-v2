import Errors from "./Errors";

class Steps{
    constructor(wizard){
        this.wizard = wizard;
        this.steps = this.getSteps();
        this.stepsQuantity = this.getStepsQuantity();
        this.currentStep = 0;
    }

    setCurrentStep(currentStep){
        this.currentStep = currentStep;
    }

    getSteps(){
        return this.wizard.getElementsByClassName('step');
    }

    getStepsQuantity(){
        return this.getSteps().length;
    }

    handleConcludeStep(){
        this.steps[this.currentStep].classList.add('-completed');
    }

    handleStepsClasses(movement){
        if(movement > 0)
            this.steps[this.currentStep - 1].classList.add('-completed');
        else if(movement < 0)
            this.steps[this.currentStep].classList.remove('-completed');
    }
}

export default Steps;