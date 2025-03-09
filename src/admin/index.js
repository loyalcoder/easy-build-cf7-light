import './scss/admin.scss';
class Offcanvas {
    constructor(element) {
      this.element = element;
      // Target both buttons that should trigger the offcanvas
      this.triggers = [
        document.querySelector('.page-title-action'),
        document.querySelector('#menu-posts-cf7-builder .wp-submenu-wrap li:last-child a')
      ];
      this.backdrop = document.createElement('div');
      this.backdrop.className = 'offcanvas-backdrop fade';
      this.isShown = false;
  
      // Add click handler to both trigger elements
      this.triggers.forEach(trigger => {
        if (trigger) {
          trigger.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggle();
          });
        }
      });

      this.element.querySelector('.btn-close').addEventListener('click', this.hide.bind(this));
      this.backdrop.addEventListener('click', this.hide.bind(this));
    }
  
    show() {
      if (this.isShown) return;
      
      document.body.appendChild(this.backdrop);
      setTimeout(() => this.backdrop.classList.add('show'), 0);
      
      this.element.style.visibility = 'visible';
      this.element.classList.add('show');
      this.isShown = true;
    }
  
    hide() {
      if (!this.isShown) return;
      
      this.backdrop.classList.remove('show');
      setTimeout(() => this.backdrop.remove(), 300);
      
      this.element.classList.remove('show');
      setTimeout(() => {
        this.element.style.visibility = 'hidden';
        this.isShown = false;
      }, 300);
    }
  
    toggle() {
      this.isShown ? this.hide() : this.show();
    }
  }
  
  // Initialize
  document.addEventListener('DOMContentLoaded', () => {
    const offcanvasElements = document.querySelectorAll('.offcanvas');
    offcanvasElements.forEach(el => new Offcanvas(el));
  });


  document.addEventListener('DOMContentLoaded', function() {
    const createNewButton = document.getElementById('cf7-create-new');
    const newFormContainer = document.getElementById('new-form-container');
    const cf7Select = document.getElementById('cf7-select');
  
    // Function to populate the select options (you'll need to implement this)
    function populateCF7Options() {
      // Fetch CF7 forms and populate the select
      // This might involve an AJAX call to the WordPress backend
    }
  
    // Call this function to populate the select options when the page loads
    populateCF7Options();
  });

  jQuery(document).ready(function($) {

    var $titleInput = $('#cf7-title');
    var $selectInput = $('#cf7-select');
    var $submitButton = $('#cf7-builder-submit');


    function checkFields() {
        var titleValue = $titleInput.length ? $titleInput.val().trim() : '';
        var selectValue = $selectInput.length ? $selectInput.val() : '';
        $submitButton.prop('disabled', !(titleValue !== '' && selectValue !== ''));
    }

    $titleInput.on('input', checkFields);
    $selectInput.on('change', checkFields);

    // Initial check on page load
    checkFields();
});
document.addEventListener('DOMContentLoaded', function() {
    const layoutItems = document.querySelectorAll('.layout-item');
    const hiddenField = document.getElementById('selected-layout');
    const submitButton = document.getElementById('cf7-builder-submit');
  
    layoutItems.forEach(item => {
      item.addEventListener('click', function() {
        layoutItems.forEach(i => i.classList.remove('selected'));
        this.classList.add('selected');
        hiddenField.value = this.getAttribute('data-layout');
        // submitButton.disabled = false;
      });
    });
  });
  