<table>
    <thead>
        <tr>
            <th> اسم </th>
            <th> المورد </th>
            <th> سعر المنتج </th>
            <th> الكمية </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->supplier->name ?? '' }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
