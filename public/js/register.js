document.addEventListener('DOMContentLoaded', function () {
  const steps = Array.from(document.querySelectorAll('.step'));
  const nextBtns = document.querySelectorAll('.next-btn');
  const prevBtns = document.querySelectorAll('.prev-btn');
  const indicators = [
    document.getElementById('step-1-indicator'),
    document.getElementById('step-2-indicator'),
    document.getElementById('step-3-indicator')
  ];

  let currentStep = 0;

  function showStep(index) {
    steps.forEach((step, i) => {
      step.style.display = i === index ? 'block' : 'none';
      indicators[i].classList.toggle('active', i === index);
    });
  }

  nextBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });
  });

  prevBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });
  });

  // Handle 'Other' options
  const industrySelect = document.getElementById('industry');
  const customIndustryContainer = document.getElementById('customIndustryContainer');
  const inventorySelect = document.getElementById('currentInventorySystem');
  const customInventorySystemContainer = document.getElementById('customInventorySystemContainer');

  industrySelect.addEventListener('change', () => {
    customIndustryContainer.classList.toggle('hidden', industrySelect.value !== 'Other');
  });

  inventorySelect.addEventListener('change', () => {
    customInventorySystemContainer.classList.toggle('hidden', inventorySelect.value !== 'other');
  });

  // Initial render
  showStep(currentStep);
});
