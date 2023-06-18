  export interface Product {
    id: number;
    name: string;
    description: string;
    voltage: string;
    brand: { name: string };
    material: string;
    department: string;
    price: number;
  }

  export interface Brand {
    id: number;
    name: string;
    description: string;
  }

  export interface RootState {
    products: Product[];
    brands: Brand[];
  }