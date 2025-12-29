<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-2">
                    <a href="/tasks" class="text-blue-600 hover:text-blue-700 text-sm">← Back to Tasks</a>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $task->title }}</h1>
                <p class="text-gray-600">{{ $task->workspace->name ?? 'No workspace' }}</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <!-- Task Details -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Task Details</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Description</label>
                                <p class="text-gray-900 mt-1">{{ $task->description ?? 'No description provided' }}</p>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Status</label>
                                    <form action="/tasks/{{ $task->id }}/status" method="POST" class="mt-1">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="text-sm border rounded px-3 py-2 w-full text-black">
                                            <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                                            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="review" {{ $task->status === 'review' ? 'selected' : '' }}>Review</option>
                                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="blocked" {{ $task->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
                                        </select>
                                    </form>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Priority</label>
                                    <div class="mt-1">
                                        @if($task->priority === 'critical' || $task->priority === 'high')
                                            <span class="bg-red-100 text-red-700 px-3 py-2 rounded text-sm font-medium inline-block">{{ ucfirst($task->priority) }}</span>
                                        @elseif($task->priority === 'medium')
                                            <span class="bg-orange-100 text-orange-700 px-3 py-2 rounded text-sm font-medium inline-block">{{ ucfirst($task->priority) }}</span>
                                        @else
                                            <span class="bg-green-100 text-green-700 px-3 py-2 rounded text-sm font-medium inline-block">{{ ucfirst($task->priority) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-700">Due Date</label>
                                <p class="text-gray-900 mt-1">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}</p>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-700">Assigned To</label>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                        {{ substr($task->assignedTo->name ?? 'N', 0, 1) }}
                                    </div>
                                    <span class="text-gray-900">{{ $task->assignedTo->name ?? 'Unassigned' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Comments</h2>
                        
                        <div class="space-y-4 mb-6">
                            @foreach($task->comments as $comment)
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 text-sm">{{ $comment->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $comment->comment }}</p>
                            </div>
                            @endforeach
                        </div>
                        
                        @if($task->comments->isEmpty())
                            <p class="text-gray-500 text-center py-4 mb-6">No comments yet. Be the first to comment!</p>
                        @endif
                        
                        <!-- Add Comment Form -->
                        <form action="/tasks/{{ $task->id }}/comments" method="POST">
                            @csrf
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Add a comment</label>
                                <textarea id="comment" name="comment" rows="3" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm text-black"
                                    placeholder="Write your comment here..."></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Task Info</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <span class="text-gray-600">Created by:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $task->creator->name ?? 'Unknown' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Created:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $task->created_at->format('M d, Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Last updated:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $task->updated_at->diffForHumans() }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Comments:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $task->comments->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-sidebar>
