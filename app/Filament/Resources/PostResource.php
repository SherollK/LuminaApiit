<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\CommentsRelationManager;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-m-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Main Content')->schema([
                TextInput::make('title')
                ->live()
                ->required()
                ->minLength(1)
                ->maxLength(150)
                ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                    if ($operation === 'edit') {
                        return;
                    }
                    $set('slug', Str::slug($state));
                }),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->minLength(1)->maxLength(150),
                TextInput::make('sub_title')
                ->live()
                ->required()
                ->minLength(1)
                ->maxLength(250),
                RichEditor::make('body')->required()->fileAttachmentsDirectory('posts/images')->columnSpanFull()
            ]
        )->columns(2),
            Section::make('Meta')->schema(
                [
                    FileUpload::make('image')->image()->directory('posts/thumbnails'),
                    DateTimePicker::make('published_at')->nullable(),
                    Checkbox::make('featured'),
                    Select::make('user_id')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->required(),
                    Select::make('categories')
                    ->multiple()
                    ->relationship('categories', 'title')
                    ->searchable(),

                ]
            ),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('author.name')->sortable()->searchable(),
                CheckboxColumn::make('featured')->sortable(),
                Tables\Columns\IconColumn::make('hide')->label('Hidden?')->boolean()
                ->sortable()
                ->searchable(),
            ])
            ->filters([Tables\Filters\TrashedFilter::make()], 

            )
            ->actions([Tables\Actions\EditAction::make(),
            self::ShowAction()])

            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make(), Tables\Actions\ForceDeleteBulkAction::make(), Tables\Actions\RestoreBulkAction::make()])])
            ->emptyStateActions([Tables\Actions\CreateAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class
            ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
    public static function ShowAction()
    {
        return Tables\Actions\Action::make('Show')
            ->icon('heroicon-o-check-circle')
            ->action(fn (Post $record) => $record->update(['hide' => false]));
           
            // $recipient = $record()->user;
            // Notification::make()
            //       ->title('Your post was approved')
            //        ->success()
            //        ->body('Your post is now visible to all of our community.')
            //        ->sendToDatabase($recipient)
            //        ->actions([
            //            Action::make('view')
            //                ->button()
            //                ->markAsRead(),
            //        ])
            //        ->send();
            // $recipient = $record()->user;
            // Notification::make()
            //       ->title('Your post was approved')
            //        ->success()
            //        ->body('Your post is now visible to all of our community.')
            //        ->sendToDatabase($recipient);
                //    ->actions([
                //        Action::make('view')
                //            ->button()
                //            ->markAsRead(),
                //    ])
                //    ->send();
               


   
   
        }
    
    public function apply($query, $value)
    {
    // Get the IDs of the current user's categories
    $userCategoryIds = auth()->user()->categories()->pluck('id');

    // Filter posts where at least one category ID matches between user's categories and post's categories
    $query->whereHas('categories', function ($query) use ($userCategoryIds) {
        $query->whereIn('id', $userCategoryIds);
    });
    }



}
