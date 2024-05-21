<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventsResource\Pages;
use App\Filament\Resources\EventsResource\RelationManagers;
use App\Models\Events;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class EventsResource extends Resource
{
    protected static bool $shouldSkipAuthorization = true; //testing purposes
    protected static ?string $model = Events::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function form(Form $form): Form
    {
        ;

        return $form
            ->schema([
                //we need the title of the event 
                //do we also need a subtitle?
                //a description 
                //date duh
                //time 
                //location 
              

                TextInput::make('title')->required(),
                Textarea::make('description')
                ->rows(10)
                ->cols(20)
                ->minLength(2)
                ->maxLength(1024),
                DatePicker::make('date')->required(),
                TimePicker::make('time')->required(),
                TextInput::make('location')->required(),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->minLength(1)->maxLength(150),
                Select::make('categories')
                ->multiple()
                ->relationship('categories', 'title')
                ->options(Category::all()->pluck('title', 'id'))
                ->required(),
                FileUpload::make('image')->image()
                                        ->imageEditor()
                                        ->imageEditorAspectRatios([
                                            '16:9',
                                            '4:3',
                                            '1:1']),
              Hidden::make('user_id')->default(auth()->id())


                // Hidden::make('user_id')->evaluate($userId)
                // Select::make('user_id')
                // ->relationship('author', 'name')
                // ->searchable()
                // ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //name of the event
                //date
                //description
                //time 
                //location 
                ImageColumn::make('image'),
                TextColumn::make('title')->searchable(),
                IconColumn::make('availability'),
      // TextColumn::make('description'), 
                TextColumn::make('date')->sortable()->dateTime(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('time'), 
                TextColumn::make('location'),
                //enter one for different faculties.  
                TextColumn::make('author.name'),
                ImageColumn::make('image')


            ])
            ->filters([
                //Basic filteration criteria
                    //prolly to filter based on date: like which ones are available today 
                    //and which events are applicable for a certain school

                    Filter::make('Available events') ->query(function (Builder $query) {
                        $today = Carbon::today();
                        $query->where('date', '>=', $today);})
                
                
                    //get another filter to show location 
                    //another to show faculty
                        //get this from the author 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvents::route('/create'),
            'edit' => Pages\EditEvents::route('/{record}/edit'),
        ];
    }

    
}
