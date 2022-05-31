import { EventEmitter, Output, Component, OnInit } from '@angular/core';
import { ProductsService } from '../../product.service';
import { Product } from '../../product';
import { faSearch } from '@fortawesome/free-solid-svg-icons';
import { faSlidersH } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-searcher',
  templateUrl: './searcher.component.html',
  styleUrls: ['./searcher.component.scss'],
})
export class SearcherComponent implements OnInit {
  filterItem: string = 'libelle';
  @Output() filterChanged = new EventEmitter<string>();
  faSearch = faSearch;
  faSlidersH = faSlidersH;
  @Output() changes = new EventEmitter<Product[]>();
  products: Product[] = [];
  search: string = '';
  constructor(private productService: ProductsService) {}

  ngOnInit(): void {
    this.filter();
  }

  update() {
    this.changes.emit(this.products);
    this.filterChanged.emit(this.filterItem);
  }

  filter() {
    if (this.search !== '') {
      return this.productService.getCatalogue().subscribe((products) => {
        this.products = products.filter((p) =>
          this.filterItem === 'libelle'
            ? p.libelle.toLowerCase().includes(this.search.toLowerCase())
            : p.prix == Number(this.search)
        );
        this.update();
      });
    } else {
      return this.productService.getCatalogue().subscribe((products) => {
        this.products = products;
        this.update();
      });
    }
  }
}
