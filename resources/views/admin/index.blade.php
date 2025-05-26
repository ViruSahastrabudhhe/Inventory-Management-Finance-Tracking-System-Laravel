@inject('users', \App\Models\User::class)

<x-layout.authenticated>
    <x-slot:title>Admin Management</x-slot>

    <div class="container">
        <div>
            <table id="table">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Is verified?</th>
                        <th>Is activated?</th>
                        <th>Account timestamps</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Actions</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Is verified?</th>
                        <th>Is activated?</th>
                        <th>Account timestamps</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users->getUsers() as $u)
                    <tr>
                        <td>
                            @if ($u->is_activated==1)
                            <form action="{{ route('admin.activate', ['userID'=>$u->id]) }}" method="POST">
                            @csrf    
                                <button type="submit">Deactivate</button>
                            </form>
                            @else
                            <form action="{{ route('admin.activate', ['userID'=>$u->id]) }}" method="POST">
                            @csrf    
                                <button type="submit">Activate</button>
                            </form>
                            @endif
                            <button>Delete</button>
                        </td>
                        <td><?php echo $u->name ?></td>
                        <td><?php echo $u->email ?></td>
                        @if ($u->email_verified_at==null)
                        <td><?php echo "No" ?></td>
                        @else
                        <td><?php echo "Yes" ?></td>
                        @endif
                        @if ($u->is_activated==1)
                        <td><?php echo "Activated" ?></td>
                        @else
                        <td><?php echo "Deactivated" ?></td>
                        @endif
                        <td>
                            Created at: <?php echo $u->created_at ?>
                            <br>
                            Updated at: <?php echo $u->updated_at ?>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('table').dataTable({});
        });
    </script>
</x-layout.authenticated>