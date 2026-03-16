export class ProductCategoryFilter {
  private navElement: HTMLElement;
  private targetElement: HTMLElement;
  private buttonElements: HTMLButtonElement[];
  private selectElement: HTMLSelectElement | null;
  private activeSlug = '';

  constructor(navElement: HTMLElement, targetElement: HTMLElement) {
    this.navElement = navElement;
    this.targetElement = targetElement;
    this.buttonElements = Array.from(
      navElement.querySelectorAll<HTMLButtonElement>('button[data-product-category-slug]')
    );
    this.selectElement = navElement.querySelector<HTMLSelectElement>('[data-product-category-select]');

    this.activeSlug = this.getInitialSlug();

    this.bindEvents();
    this.syncUi();
    this.filter(this.activeSlug);
  }

  private getInitialSlug() {
    const activeButton = this.buttonElements.find((element) => element.classList.contains('is-active'));
    if (activeButton) {
      return activeButton.dataset.productCategorySlug ?? '';
    }

    if (this.selectElement) {
      return this.selectElement.value;
    }

    return '';
  }

  private bindEvents() {
    this.navElement.addEventListener('click', (event) => {
      const target = event.target;

      if (!(target instanceof Element)) {
        return;
      }

      const buttonElement = target.closest<HTMLButtonElement>('button[data-product-category-slug]');
      if (!buttonElement) {
        return;
      }

      this.setActiveSlug(buttonElement.dataset.productCategorySlug ?? '');
    });

    this.selectElement?.addEventListener('change', () => {
      this.setActiveSlug(this.selectElement?.value ?? '');
    });
  }

  private setActiveSlug(slug: string) {
    if (this.activeSlug === slug) {
      return;
    }

    this.activeSlug = slug;
    this.syncUi();
    this.filter(slug);
  }

  private syncUi() {
    this.buttonElements.forEach((element) => {
      element.classList.toggle('is-active', (element.dataset.productCategorySlug ?? '') === this.activeSlug);
    });

    if (this.selectElement && this.selectElement.value !== this.activeSlug) {
      this.selectElement.value = this.activeSlug;
    }
  }

  private filter(slug: string) {
    this.targetElement.querySelectorAll<HTMLElement>('[data-product-category-slugs]').forEach((element) => {
      let slugs: string[] = [];

      try {
        const rawValue = element.dataset.productCategorySlugs ?? '[]';
        const parsedValue = JSON.parse(rawValue);

        if (Array.isArray(parsedValue)) {
          slugs = parsedValue.filter((item): item is string => typeof item === 'string');
        }
      } catch {
        console.warn('Invalid data-product-category-slugs', element);
      }

      element.hidden = Boolean(slug && !slugs.includes(slug));
    });
  }

  static init() {
    document.querySelectorAll<HTMLElement>('[data-product-category-nav]').forEach((navElement) => {
      const targetElementId = navElement.dataset.productCategoryNav;
      if (!targetElementId) {
        console.warn('Missing data-product-category-nav', navElement);
        return;
      }

      const targetElement = document.getElementById(targetElementId);
      if (!(targetElement instanceof HTMLElement)) {
        console.warn(`Target element "${targetElementId}" not found`, navElement);
        return;
      }

      new ProductCategoryFilter(navElement, targetElement);
    });
  }
}
