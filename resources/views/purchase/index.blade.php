@inject('purchases', \App\Models\Purchase::class)

<x-layout.authenticated>
    <x-slot:title>Manage Purchases</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-add-purchases') }}">
                <button>
                    Create purchase order
                </button>
            </a>
        </div>

        <div>
            <table>
                <tbody>
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Purchase no.</th>
                        <th>Purchase status</th>
                        <th>Purchase date</th>
                        <th>Completion date</th>
                    </tr>
                    @foreach($purchases->getPurchases() as $key=>$p)
                    <tr onclick="window.location='{{ route('view-purchase-info', ['purchase'=>$p]) }}'">
                        <td>
                            <button>Edit</button>
                            <button>Complete</button>
                            <button>Delete</button>
                        </td>
                        <td><?php echo $key+1 ?></td>
                        <td>PO<?php echo $p->purchase_no ?></td>
                        <td><?php echo $p->purchase_status ?></td>
                        <td><?php echo $p->purchase_date ?></td>
                        @if ($p->completion_date==null)
                        <td>-</td>
                        @else
                        <td><?php echo $p->completion_date ?></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>